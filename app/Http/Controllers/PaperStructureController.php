<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\PaperStructure;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class PaperStructureController extends Controller
{
    public function paperStructureUploadSignedDoc(Request $request, Student $student)
    {
        $data = $request->validate([
            'signed_document' => 'required|file|mimes:pdf',
        ]);

        $paperStructureExists = $student->paperStructure->exists();

        if (!$paperStructureExists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedPreliminaryletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de anteproyecto',
            ]);
        }

        if (!$student->approvedPreliminaryletter->signed_document){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Aún no se ha cargado el documento final del anteproyecto',
            ]);
        }

        $student->paperStructure()->create($data);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function paperStructureDownloadSignedDoc(Student $student)
    {
        $paperStructure = $student->paperStructure;

        if (!$paperStructure->exists()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La estructura del informe final no ha sido cargada',
            ]);
        }

        return response()->file(storage_path("app/{$paperStructure->signed_document}"));
    }

    public function paperStructureCorrections(Request $request, Student $student)
    {
        $paperStructure = $student->inProcessPaperStructure;

        if (!$paperStructure) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La estructura del informe final debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $paperStructure->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $paperStructure->corrections()->create(['content' => $data['corrections']]);

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

    public function paperStructureMarkCorrectionsAsSolved()
    {
        $paperStructure = PaperStructure::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$paperStructure->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La estructura del informe final no necesita correciones',
            ]);
        }

        $paperStructure->status = DocumentStatus::STATUS_PROCESSING;

        $paperStructure->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function paperStructureMarkAsApproved(Student $student)
    {
        $paperStructure = $student->inProcessPaperStructure;

        if (!$paperStructure) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La estructura del informe final debe estar en proceso para porder ser revisada',
            ]);
        }

        $paperStructure->status = DocumentStatus::STATUS_APPROVED;

        $paperStructure->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La estructura del informe final ha sido aprovada',
        ]);
    }
}
