<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\AcceptanceLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AcceptanceLetterController extends Controller
{
    public function acceptanceLetterUploadSignedDoc(Request $request, Student $student)
    {
        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        $acceptanceLetterExists = $student->acceptanceLetter->exists;

        if (!$acceptanceLetterExists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedCommitmentletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de presentacion',
            ]);
        }

        if (!$student->approvedCommitmentletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final de la carta de compromiso',
            ]);
        }

        $student->acceptanceLetter()->create($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function acceptanceLetterDownloadSignedDoc(Student $student)
    {
        $acceptanceLetter = $student->acceptanceLetter;

        if (!$acceptanceLetter->exists) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta aceptación no ha sido cargada',
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
