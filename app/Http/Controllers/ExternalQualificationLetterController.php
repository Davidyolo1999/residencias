<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\Configuration;
use App\Models\ExternalQualificationLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Throwable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExternalQualificationLetterController extends Controller
{
    public function externalQualificationLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
            $configuration = Configuration::firstOrfail();

        if (!$student->externalQualificationLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedComplianceletter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la cédula de cumplimiento',
            ]);
        }

        if (!$student->approvedComplianceletter->signed_document) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la cédula de cumplimiento',
            ]);
        }

        $externalQualificationLetter = $student->externalQualificationLetter->exists
            ? $student->externalQualificationLetter
            : $student->externalQualificationLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.external-qualification-letter', [
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'externalQualificationLetter'=> $externalQualificationLetter,
            'configuration'=>$configuration,
        ]);

        $customReportName = 'Formato Evaluación Externo-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }
    public function externalQualificationLetterCorrections(Request $request, Student $student)
    {
        $externalQualificationLetter = $student->inProcessExternalQualificationLetter;

        if (!$externalQualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El formato evaluación externo debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $externalQualificationLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $externalQualificationLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function externalQualificationLetterMarkCorrectionsAsSolved()
    {
        $externalQualificationLetter = ExternalQualificationLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$externalQualificationLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El formato evaluación externo no necesita correcciones',
            ]);
        }

        $externalQualificationLetter->status = DocumentStatus::STATUS_PROCESSING;

        $externalQualificationLetter->save();

        $externalQualificationLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function externalQualificationLetterMarkAsApproved(Student $student)
    {
        $externalQualificationLetter = $student->inProcessExternalQualificationLetter;

        if (!$externalQualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El formato evaluación externo debe estar en proceso para poder ser revisado',
            ]);
        }

        $externalQualificationLetter->status = DocumentStatus::STATUS_APPROVED;

        $externalQualificationLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El formato evaluación externo ha sido aprovado',
        ]);
    }

    public function externalQualificationLetterUploadSignedDoc(Request $request, Student $student)
    {
        //
        $externalQualificationLetter = $student->approvedExternalQualificationLetter;

        if (!$externalQualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El formato evaluación externo debe ser aprovado',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($externalQualificationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $externalQualificationLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function externalQualificationLetterDownloadSignedDoc(Student $student)
    {
        //
        $externalQualificationLetter = $student->approvedExternalQualificationLetter;

        if (!$externalQualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El formato evaluación externo debe ser aprovado',
            ]);
        }

        if (!$externalQualificationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$externalQualificationLetter->signed_document}"));
    }
}
