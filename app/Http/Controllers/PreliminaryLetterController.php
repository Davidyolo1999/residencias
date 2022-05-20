<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\Configuration;
use App\Models\PreliminaryLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Carbon\Carbon;

class PreliminaryLetterController extends Controller
{

    public function preliminaryLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        $configuration = Configuration::firstOrFail();

        if (!$student->preliminaryLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedAssignmentletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de asignación',
            ]);
        }

        if (!$student->approvedAssignmentletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la asignación de asesor interno',
            ]);
        }

        $preliminaryLetter = $student->preliminaryLetter->exists
            ? $student->preliminaryLetter
            : $student->preliminaryLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.preliminary-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'preliminaryLetter'=> $preliminaryLetter,
            'configuration' => $configuration,
        ]);

        $customReportName = 'Anteproyecto de Residencias Profesionales-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);

    }

    public function preliminaryLetterCorrections(Request $request, Student $student)
    {
        $preliminaryLetter = $student->inProcessPreliminaryLetter;

        if (!$preliminaryLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de anteproyecto debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $preliminaryLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $preliminaryLetter->corrections()->create(['content' => $data['corrections']]);

            DB::commit();
        } catch(Throwable $t) {
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

    public function preliminaryLetterMarkCorrectionsAsSolved()
    {
        $preliminaryLetter = PreliminaryLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$preliminaryLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El anteproyecto no necesita correcciones',
            ]);
        }

        $preliminaryLetter->status = DocumentStatus::STATUS_PROCESSING;

        $preliminaryLetter->save();

        $preliminaryLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function preliminaryLetterMarkAsApproved(Student $student)
    {
        $preliminaryLetter = $student->inProcessPreliminaryLetter;

        if (!$preliminaryLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de anteproyecto debe estar en proceso para porder ser revisada',
            ]);
        }

        $preliminaryLetter->status = DocumentStatus::STATUS_APPROVED;

        $preliminaryLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de anteproyecto ha sido aprovada',
        ]);
    }

    public function preliminaryLetterUploadSignedDoc(Request $request, Student $student)
    {
        $preliminaryLetter = $student->approvedPreliminaryLetter;

        if (!$preliminaryLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta anteproyecto debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($preliminaryLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $preliminaryLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function preliminaryLetterDownloadSignedDoc(Student $student)
    {
        $preliminaryLetter = $student->approvedPreliminaryLetter;

        if (!$preliminaryLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta anteproyecto debe ser aprovada',
            ]);
        }

        if (!$preliminaryLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$preliminaryLetter->signed_document}"));
    }


}
