<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\ComplianceLetter;
use App\Models\ComplianceLetterQuestion;
use App\Models\Configuration;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Carbon\Carbon;

class ComplianceLetterController extends Controller
{
    public function complianceLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        $configuration = Configuration::firstOrfail();

        if (!$student->complianceLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedPaperStructure){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la estructura del informe final',
            ]);
        }

        if ($student->complianceLetter->exists) {
            $complianceLetter = $student->complianceLetter;
        } else {
            $complianceLetter = $student->complianceLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

            $questions = collect(config('documents.complianceQuestions'));

            $questions->each(function($questionData) use ($complianceLetter) {
                if (is_array($questionData)) {
                    [$parentQuestion, $childrenQuestions] = $questionData;

                    $question = $complianceLetter->questions()->create([
                        'name' => $parentQuestion,
                    ]);

                    foreach ($childrenQuestions as $childQuestion) {
                        $complianceLetter->questions()->create([
                            'name' => $childQuestion,
                            'parent_id' => $question->id,
                        ]);
                    }
                } else {
                    $question = $complianceLetter->questions()->create([
                        'name' => $questionData,
                    ]);
                }
            });
        }

        $complianceLetter->load('parentQuestions.children');

        $pdf = PDF::loadView('residency-process.compliance-letter',[
            'student'=> $student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'complianceLetter'=> $complianceLetter,
            'configuration' => $configuration,
        ]);

        $customReportName = 'Cédula de Cumplimiento de Residencias Profesionales-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }

    public function answerQuestions(Request $request, Student $student)
    {
        if (!$student->complianceLetter->exists) {
            return back()->with('alert', [
                'message' => 'No se generado la cédula de cumplimiento.',
                'type' => 'danger',
            ]);
        }
        
        if ($student->approvedComplianceLetter) {
            return back()->with('alert', [
                'message' => 'No se pueden modificar las respuestas, la cédula de cumplimiento ya está aprovada.',
                'type' => 'danger',
            ]);
        }

        $questions = $request->input('questions', []);

        $observations = $request->input('observations', []);

        $student->complianceLetter->questions->each(function($question) use ($questions, $observations) {
            $question->is_fulfilled = ($questions[$question->id] ?? 'off') === 'on';
            $question->observation = $observations[$question->id];
            $question->save();
        });

        return back()->with('alert', [
            'message' => 'Las respuestas han sido respondidas con éxito!',
            'type' => 'success',
        ]);
    }

    public function complianceLetterCorrections(Request $request, Student $student)
    {
        $complianceLetter = $student->inProcessComplianceLetter;

        if (!$complianceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de cumplimiento debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $complianceLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $complianceLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function complianceLetterMarkCorrectionsAsSolved()
    {
        $complianceLetter = ComplianceLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$complianceLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La cedula de cumpliento no necesita correcciones',
            ]);
        }

        $complianceLetter->status = DocumentStatus::STATUS_PROCESSING;

        $complianceLetter->save();

        $complianceLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function complianceLetterMarkAsApproved(Student $student)
    {
        $complianceLetter = $student->inProcessComplianceLetter;

        if (!$complianceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La cedula de cumpliento debe estar en proceso para porder ser revisada',
            ]);
        }

        $complianceLetter->status = DocumentStatus::STATUS_APPROVED;

        $complianceLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La cedula de cumpliento ha sido aprovada',
        ]);
    }

    public function complianceLetterUploadSignedDoc(Request $request, Student $student)
    {
        $complianceLetter = $student->approvedComplianceLetter;

        if (!$complianceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La cedula de cumpliento  debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($complianceLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $complianceLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function complianceLetterDownloadSignedDoc(Student $student)
    {
        $complianceLetter = $student->approvedComplianceLetter;

        if (!$complianceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La cedula de cumpliento debe ser aprovada',
            ]);
        }

        if (!$complianceLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$complianceLetter->signed_document}"));
    }
}
