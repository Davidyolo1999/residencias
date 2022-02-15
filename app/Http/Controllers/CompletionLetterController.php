<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\CompletionLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompletionLetterController extends Controller
{
    public function completionLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->completionLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedQualificationletter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de calificación',
            ]);
        }

        if (!$student->approvedQualificationletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la acta de calificación',
            ]);
        }

        $completionLetter = $student->completionLetter->exists
            ? $student->completionLetter
            : $student->completionLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.completion-letter', [
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'completionLetter'=> $completionLetter,
        ]);

        return $pdf->stream('completion-letter');

    }
    public function completionLetterCorrections(Request $request, Student $student)
    {
        $completionLetter = $student->inProcesscompletionLetter;

        if (!$completionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de término debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $completionLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $completionLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function completionLetterMarkCorrectionsAsSolved()
    {
        $completionLetter = CompletionLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$completionLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de término no necesita correcciones',
            ]);
        }

        $completionLetter->status = DocumentStatus::STATUS_PROCESSING;

        $completionLetter->save();
        
        $completionLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));


        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function completionLetterMarkAsApproved(Student $student)
    {
        $completionLetter = $student->inProcessCompletionLetter;

        if (!$completionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de término debe estar en proceso para porder ser revisada',
            ]);
        }

        $completionLetter->status = DocumentStatus::STATUS_APPROVED;

        $completionLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de término ha sido aprovada',
        ]);
    }

    public function completionLetterUploadSignedDoc(Request $request, Student $student)
    {
        $completionLetter = $student->approvedCompletionLetter;

        if (!$completionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de término debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($completionLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $completionLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function completionLetterDownloadSignedDoc(Student $student)
    {
        $completionLetter = $student->approvedCompletionLetter;

        if (!$completionLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de término debe ser aprovada',
            ]);
        }

        if (!$completionLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$completionLetter->signed_document}"));
    }
}
