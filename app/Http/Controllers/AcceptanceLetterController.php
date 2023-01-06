<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\AcceptanceLetter;
use App\Models\Configuration;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Throwable;

class AcceptanceLetterController extends Controller
{
    public function acceptanceLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        $configuration = $student->period;

        if (!$student->acceptanceLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedCommitmentletter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de compromiso',
            ]);
        }
        if (!$student->approvedCommitmentletter->signed_document) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de compromiso',
            ]);
        }

        $acceptanceLetter = $student->acceptanceLetter->exists
            ? $student->acceptanceLetter
            : $student->acceptanceLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,

            ]);

        $pdf = PDF::loadView('residency-process.acceptance-letter', [
            'student' => $student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'acceptanceLetter' => $acceptanceLetter,
            'configuration' => $configuration,
        ]);

        $customReportName = 'Carta de Aceptación-' . $student->full_name . '_' . Carbon::now()->format('d-m-Y') . '.pdf';
        return $pdf->stream($customReportName);
    }

    public function acceptanceLetterUploadSignedDoc(Request $request, Student $student)
    {
        $acceptanceLetter = $student->approvedAcceptanceLetter;

        if (!$acceptanceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de aceptación debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($acceptanceLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $acceptanceLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function acceptanceLetterDownloadSignedDoc(Student $student)
    {
        $acceptanceLetter = $student->approvedAcceptanceLetter;

        if (!$acceptanceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta anteproyecto debe ser aprovada',
            ]);
        }

        if (!$acceptanceLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$acceptanceLetter->signed_document}"));
    }

    public function acceptanceLetterCorrections(Request $request, Student $student)
    {
        $acceptanceLetter = $student->inProcessAcceptanceLetter;

        if (!$acceptanceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de aceptación debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $acceptanceLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $acceptanceLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function acceptanceLetterMarkCorrectionsAsSolved()
    {
        $acceptanceLetter = AcceptanceLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$acceptanceLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de aceptación no necesita correciones',
            ]);
        }

        $acceptanceLetter->status = DocumentStatus::STATUS_PROCESSING;

        $acceptanceLetter->save();

        $acceptanceLetter->corrections->each(fn ($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function acceptanceLetterMarkAsApproved(Student $student)
    {
        $acceptanceLetter = $student->inProcessAcceptanceLetter;

        if (!$acceptanceLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de aceptación debe estar en proceso para porder ser revisada',
            ]);
        }

        $acceptanceLetter->status = DocumentStatus::STATUS_APPROVED;

        $acceptanceLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de aceptación ha sido aprovada',
        ]);
    }
}
