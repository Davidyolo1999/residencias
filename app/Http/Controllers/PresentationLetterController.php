<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Student;
use App\Enum\DocumentStatus;
use App\Models\Configuration;
use App\Models\PresentationLetter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresentationLetterController extends Controller
{

    public function presentationLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
        $configuration = Configuration::firstOrfail();

        if (!$student->presentationLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedResidencyRequest){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la solicitud de residencia',
            ]);
        }

        if (!$student->approvedResidencyRequest->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la petición de residencia',
            ]);
        }

        $presentationLetter = $student->presentationLetter->exists
            ? $student->presentationLetter
            : $student->presentationLetter()->create([
                'request_date' => now(),
            ]);

        $pdf = PDF::loadView('residency-process.presentation-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'presentationLetter'=>$presentationLetter,
            'configuration'=>$configuration,
        ]);

        $customReportName = 'Carta Presentación-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }

    public function presentatioLetterCorrections(Request $request, Student $student)
    {
        $presentationLetter = $student->inProcessPresentationLetter;

        if (!$presentationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de presentación debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $presentationLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $presentationLetter->corrections()->create(['content' => $data['corrections']]);

            DB::commit();
        } catch (Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde',
            ]);
        }

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron envias correctamente',
        ]);
    }

    public function presentationLetterMarkCorrectionsAsSolved()
    {
        $presentationLetter = PresentationLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$presentationLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de presentación no necesita correciones',
            ]);
        }

        $presentationLetter->status = DocumentStatus::STATUS_PROCESSING;

        $presentationLetter->save();

        $presentationLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function presentationLetterMarkAsApproved(Student $student)
    {
        $presentationLetter = $student->inProcessPresentationLetter;

        if (!$presentationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de presentación debe estar en proceso para porder ser revisada',
            ]);
        }

        $presentationLetter->status = DocumentStatus::STATUS_APPROVED;

        $presentationLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de presentación ha sido aprovada',
        ]);
    }
    public function presentationLetterUploadSignedDoc(Request $request, Student $student)
    {
        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        $presentationLetter = $student->approvedPresentationLetter;

        if (!$presentationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de presentación debe ser aprovada',
            ]);
        }

        if ($presentationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $presentationLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }
    public function presentationLetterDownloadSignedDoc(Student $student)
    {
        $presentationLetter = $student->approvedPresentationLetter;

        if (!$presentationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de presentacion debe ser aprovada',
            ]);
        }

        if (!$presentationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$presentationLetter->signed_document}"));
    }
}
