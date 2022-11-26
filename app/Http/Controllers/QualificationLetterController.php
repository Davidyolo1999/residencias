<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\Configuration;
use App\Models\QualificationLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Carbon\Carbon;

class QualificationLetterController extends Controller
{
    public function qualificationLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        $configuration = Configuration::firstOrfail();


        if (!$student->qualificationLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedExternalQualificationLetter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada el formato evaluación externo',
            ]);
        }

        if (!$student->approvedExternalQualificationLetter->signed_document) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final del formato evaluación externo',
            ]);
        }

        $qualificationLetter = $student->qualificationLetter->exists
            ? $student->qualificationLetter
            : $student->qualificationLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.qualification-letter', [
            'student' => $student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'qualificationLetter' => $qualificationLetter,
            'configuration' => $configuration,
        ]);

        $customReportName = 'Acta de Calificación de Residencias Profesionales-' . $student->full_name . '_' . Carbon::now()->format('d-m-Y') . '.pdf';
        return $pdf->stream($customReportName);
    }

    public function qualificationLetterCorrections(Request $request, Student $student)
    {
        $qualificationLetter = $student->inProcessQualificationLetter;

        if (!$qualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $qualificationLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $qualificationLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function qualificationLetterMarkCorrectionsAsSolved()
    {
        $qualificationLetter = QualificationLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$qualificationLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación no necesita correcciones',
            ]);
        }

        $qualificationLetter->status = DocumentStatus::STATUS_PROCESSING;

        $qualificationLetter->save();

        $qualificationLetter->corrections->each(fn ($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function qualificationLetterMarkAsApproved(Request $request, Student $student)
    {
        $data = $request->validate([
            'qualification' => 'required|integer|min:0|max:100',
            'qualification_text' => 'required|max:255',
        ]);

        $qualificationLetter = $student->inProcessQualificationLetter;

        if (!$qualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación debe estar en proceso para porder ser revisada',
            ]);
        }

        $qualificationLetter->fill($data);
        $qualificationLetter->status = DocumentStatus::STATUS_APPROVED;

        $qualificationLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de calificación ha sido aprovada',
        ]);
    }

    public function qualificationLetterModify(Request $request, Student $student)
    {
        $data = $request->validate([
            'qualification' => 'required|integer|min:0|max:100',
            'qualification_text' => 'required|max:255',
        ]);

        $qualificationLetter = $student->qualificationLetter;

        if (!$qualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación no existe.',
            ]);
        }

        $qualificationLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de calificación ha sido actualizada.',
        ]);
    }

    public function qualificationLetterUploadSignedDoc(Request $request, Student $student)
    {
        $qualificationLetter = $student->approvedQualificationLetter;

        if (!$qualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación  debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($qualificationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $qualificationLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function qualificationLetterDownloadSignedDoc(Student $student)
    {
        $qualificationLetter = $student->approvedQualificationLetter;

        if (!$qualificationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de calificación debe ser aprovada',
            ]);
        }

        if (!$qualificationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$qualificationLetter->signed_document}"));
    }
}
