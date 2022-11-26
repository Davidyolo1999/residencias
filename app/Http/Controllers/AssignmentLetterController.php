<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\AssignmentLetter;
use App\Models\Configuration;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Throwable;

class AssignmentLetterController extends Controller
{
    public function assignmentLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
        $configuration=Configuration::firstOrfail();

        if (!$student->assignmentLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedAuthorizationLetter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de uso de información',
            ]);
        }
        if (!$student->approvedAuthorizationletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de uso de información',
            ]);
        }

        $assignmentLetter = $student->assignmentLetter->exists
            ? $student->assignmentLetter
            : $student->assignmentLetter()->create([
                'request_date' => now(),
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.assignment-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'assignmentLetter'=> $assignmentLetter,
            'configuration'=> $configuration,
        ]);

        $customReportName = 'Asignación de Asesor Interno-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }

    public function assignmentLetterCorrections(Request $request, Student $student)
    {
        $assignmentLetter = $student->inProcessAssignmentLetter;

        if (!$assignmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de asignación debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $assignmentLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $assignmentLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function assignmentLetterMarkCorrectionsAsSolved()
    {
        $assignmentLetter = AssignmentLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$assignmentLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de asignación no necesita correciones',
            ]);
        }

        $assignmentLetter->status = DocumentStatus::STATUS_PROCESSING;

        $assignmentLetter->save();

        $assignmentLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function assignmentLetterMarkAsApproved(Student $student)
    {
        $assignmentLetter = $student->inProcessAssignmentLetter;

        if (!$assignmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de asignación debe estar en proceso para porder ser revisada',
            ]);
        }

        $assignmentLetter->status = DocumentStatus::STATUS_APPROVED;

        $assignmentLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de asignación ha sido aprovada',
        ]);
    }

    public function assignmentLetterUploadSignedDoc(Request $request, Student $student)
    {
        $assignmentLetter = $student->approvedAssignmentLetter;

        if (!$assignmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta asignación debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($assignmentLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $assignmentLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function assignmentLetterDownloadSignedDoc(Student $student)
    {
        $assignmentLetter = $student->approvedAssignmentLetter;

        if (!$assignmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta asignación debe ser aprovada',
            ]);
        }

        if (!$assignmentLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$assignmentLetter->signed_document}"));
    }
}
