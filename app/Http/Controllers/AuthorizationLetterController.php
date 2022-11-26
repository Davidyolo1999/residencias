<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\AuthorizationLetter;
use App\Models\Configuration;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthorizationLetterController extends Controller
{
    public function authorizationLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
            $configuration = Configuration::firstOrfail();

        if (!$student->authorizationLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedAcceptanceletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de aceptaciòn',
            ]);
        }
        if (!$student->approvedAcceptanceletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de presentación',
            ]);
        }

        $authorizationLetter = $student->authorizationLetter->exists
            ? $student->authorizationLetter
            : $student->authorizationLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.authorization-letter', [
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'authorizationLetter'=> $authorizationLetter,
            'configuration'=>$configuration,
        ]);

        $customReportName = 'Autorización de uso de Información-'.$student->full_name.'_'.Carbon::now()->format('d-m-Y').'.pdf'; 
        return $pdf->stream($customReportName);
    }
    public function authorizationLetterCorrections(Request $request, Student $student)
    {
        $authorizationLetter = $student->inProcessAuthorizationLetter;

        if (!$authorizationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de autorización de uso de información debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $authorizationLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $authorizationLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function authorizationLetterMarkCorrectionsAsSolved()
    {
        //
        $authorizationLetter = AuthorizationLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$authorizationLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta autorización de uso de información no necesita correcciones',
            ]);
        }

        $authorizationLetter->status = DocumentStatus::STATUS_PROCESSING;

        $authorizationLetter->save();

        $authorizationLetter->corrections->each(fn($correction) => $correction->update(['is_solved' => true]));

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function authorizationLetterMarkAsApproved(Student $student)
    {
        //
        $authorizationLetter = $student->inProcessAuthorizationLetter;

        if (!$authorizationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de autorización de uso de información debe estar en proceso para poder ser revisada',
            ]);
        }

        $authorizationLetter->status = DocumentStatus::STATUS_APPROVED;

        $authorizationLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de autorización de uso de información ha sido aprovada',
        ]);
    }

    public function authorizationLetterUploadSignedDoc(Request $request, Student $student)
    {
        //
        $authorizationLetter = $student->approvedAuthorizationLetter;

        if (!$authorizationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de autorización de uso de información debe ser aprovada',
            ]);
        }

        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        if ($authorizationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento ya ha sido cargado.',
            ]);
        }

        $authorizationLetter->update($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function authorizationLetterDownloadSignedDoc(Student $student)
    {
        //
        $authorizationLetter = $student->approvedAuthorizationLetter;

        if (!$authorizationLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de autorización de uso de información debe ser aprovada',
            ]);
        }

        if (!$authorizationLetter->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cargado aún',
            ]);
        }

        return response()->file(storage_path("app/{$authorizationLetter->signed_document}"));
    }
}
