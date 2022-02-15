<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Student;
use App\Enum\DocumentStatus;
use Illuminate\Http\Request;
use App\Models\ResidencyRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResidencyRequestUploadSignedDocRequest;

class ResidencyRequestController extends Controller
{
    public function residencyRequest(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->with(['residencyRequest', 'project', 'company'])
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->is_enrolled) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe estar inscrito',
            ]);
        }

        if (!$student->is_social_service_concluded) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe terminar el servicio social',
            ]);
        }

        if ($student->career_percentage < 85) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe tener al menos el 85% de la carrera aprovada.',
            ]);
        }
        
        if (!$student->residencyRequest->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->project) {
            return redirect()->route('students.projectInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data del proyecto',
            ]);
        }

        if (!$student->company) {
            return redirect()->route('students.companyInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data de la compañia externa',
            ]);
        }

        $residencyRequest = $student->residencyRequest->exists
            ? $student->residencyRequest
            : $student->residencyRequest()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.residency-request', [
            'student' => $student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'residencyRequest' => $residencyRequest,
        ]);

        return $pdf->stream('residency-request.pdf');
    }

    public function residencyRequestCorrections(Request $request, Student $student)
    {
        $residencyRequest = $student->inProcessResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $residencyRequest->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $residencyRequest->corrections()->create(['content' => $data['corrections']]);

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

    public function residencyRequestMarkCorrectionsAsSolved()
    {
        $residencyRequest = ResidencyRequest::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$residencyRequest->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia no necesita correciones',
            ]);
        }

        $residencyRequest->status = DocumentStatus::STATUS_PROCESSING;

        $residencyRequest->save();

        $residencyRequest->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function residencyRequestMarkAsApproved(Student $student)
    {
        $residencyRequest = $student->inProcessResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe estar en proceso para porder ser revisada',
            ]);
        }

        $residencyRequest->status = DocumentStatus::STATUS_APPROVED;

        $residencyRequest->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La petición de residencia ha sido aprovada',
        ]);
    }

    public function residencyRequestUploadSignedDoc(ResidencyRequestUploadSignedDocRequest $request, Student $student)
    {
        $residencyRequest = $student->approvedResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe aprovada',
            ]);
        }

        if ($residencyRequest->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $residencyRequest->update($request->validated());

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function residencyRequestDownloadSignedDoc(Student $student)
    {
        $residencyRequest = $student->approvedResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe aprovada',
            ]);
        }

        if (!$residencyRequest->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$residencyRequest->signed_document}"));
    }
}
