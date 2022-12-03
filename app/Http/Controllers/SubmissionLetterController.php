<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\Configuration;
use App\Models\Student;
use App\Models\SubmissionLetter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Carbon\Carbon;

class SubmissionLetterController extends Controller
{

    public function submissionLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
            $configuration = Configuration::firstOrfail();

        if (!$student->submissionLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedCompletionletter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de término',
            ]);
        }

        if (!$student->approvedCompletionletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de término',
            ]);
        }

        $submissionLetter = $student->submissionLetter->exists
            ? $student->submissionLetter
            : $student->submissionLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.submission-letter', [
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'submissionLetter'=> $submissionLetter,
            'configuration'=>$configuration,
        ]);

        $customReportName = 'Constancia de Entrega de Proyecto-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }

    public function submissionLetterCorrections(Request $request, Student $student)
    {
        $submissionLetter = $student->inProcessSubmissionLetter;

        if (!$submissionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de entrega de proyecto debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $submissionLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $submissionLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function submissionLetterMarkCorrectionsAsSolved()
    {
        $submissionLetter = SubmissionLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$submissionLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de entrega de proyecto no necesita correcciones',
            ]);
        }

        $submissionLetter->status = DocumentStatus::STATUS_PROCESSING;

        $submissionLetter->save();

        $submissionLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function submissionLetterMarkAsApproved(Student $student)
    {
        $submissionLetter = $student->inProcessSubmissionLetter;

        if (!$submissionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de entrega de proyecto debe estar en proceso para porder ser revisada',
            ]);
        }

        $submissionLetter->status = DocumentStatus::STATUS_APPROVED;

        $submissionLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de entrega de proyecto ha sido aprovada',
        ]);
    }

    public function submissionLetterUploadSignedDoc(Request $request, Student $student)
    {
        $submissionLetter = $student->approvedSubmissionLetter;

        if (!$submissionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de entrega de proyecto debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($submissionLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $submissionLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ])->with('processFinished', true);
    }

    public function submissionLetterDownloadSignedDoc(Student $student)
    {
        $submissionLetter = $student->approvedSubmissionLetter;

        if (!$submissionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de entrega de proyecto debe ser aprovada',
            ]);
        }

        if (!$submissionLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$submissionLetter->signed_document}"));
    }
}
