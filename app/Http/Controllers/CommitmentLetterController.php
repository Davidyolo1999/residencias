<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\CommitmentLetter;
use App\Models\Configuration;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Throwable;

class CommitmentLetterController extends Controller
{
    public function commitmentLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        $configuration=Configuration::firstOrfail();

        if (!$student->commitmentLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedPresentationletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de presentacion',
            ]);
        }

        if (!$student->approvedPresentationletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de presentación',
            ]);
        }

        $commitmentLetter = $student->commitmentLetter->exists
            ? $student->commitmentLetter
            : $student->commitmentLetter()->create([
                'request_date' => now(),
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.commitment-letter',[
            'student'=> $student,
            'externalCompany' => $student->company,
            'commitmentLetter'=> $commitmentLetter,
            'configuration'=> $configuration,
        ]);

        $customReportName = 'Carta Compromiso-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }

    public function commitmentLetterCorrections(Request $request, Student $student)
    {
        $commitmentLetter = $student->inProcessCommitmentLetter;

        if (!$commitmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $commitmentLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $commitmentLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function commitmentLetterMarkCorrectionsAsSolved()
    {
        $commitmentLetter = CommitmentLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$commitmentLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso no necesita correciones',
            ]);
        }

        $commitmentLetter->status = DocumentStatus::STATUS_PROCESSING;

        $commitmentLetter->save();

        $commitmentLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function commitmentLetterMarkAsApproved(Student $student)
    {
        $commitmentLetter = $student->inProcessCommitmentLetter;

        if (!$commitmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso debe estar en proceso para porder ser revisada',
            ]);
        }

        $commitmentLetter->status = DocumentStatus::STATUS_APPROVED;

        $commitmentLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de compromiso ha sido aprovada',
        ]);
    }

    public function commitmentLetterUploadSignedDoc(Request $request, Student $student)
    {
        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        $commitmentLetter = $student->approvedCommitmentLetter;

        if (!$commitmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta compromiso debe ser aprovada',
            ]);
        }

        if ($commitmentLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $commitmentLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function commitmentLetterDownloadSignedDoc(Student $student)
    {
        $commitmentLetter = $student->approvedCommitmentLetter;

        if (!$commitmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta compromiso debe ser aprovada',
            ]);
        }

        if (!$commitmentLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$commitmentLetter->signed_document}"));
    }
}
