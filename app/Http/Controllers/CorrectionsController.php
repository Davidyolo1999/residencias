<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\Correction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CorrectionsController extends Controller
{
    public function markAsSolved(Request $request, $correctionId)
    {
        $request->validate([
            'document_type' => [
                'required',
                Rule::in([
                    'App\Models\ResidencyRequest',
                    'App\Models\PresentationLetter', 
                    'App\Models\CommitmentLetter', 
                    'App\Models\AcceptanceLetter', 
                    'App\Models\AssignmentLetter', 
                    'App\Models\PreliminaryLetter', 
                    'App\Models\PaperStructure', 
                    'App\Models\ComplianceLetter',
                    'App\Models\QualificationLetter',
                    'App\Models\CompletionLetter',
                    'App\Models\SubmissionLetter',
                ]),
            ],
        ]);

        $correction = Correction::query()
            ->where('id', $correctionId)
            ->where('correctionable_type', $request->document_type)
            ->whereHas('correctionable', fn($query) => $query->where('user_id', Auth::id()))
            ->firstOrFail();

        $correction->update(['is_solved' => 1]);

        $document = $correction->correctionable;
        
        $unsolvedCorrectionsCount = $document
            ->corrections
            ->filter(fn($correction) => !$correction->is_solved)
            ->count();

        if ($unsolvedCorrectionsCount === 0 && $document->status === DocumentStatus::STATUS_NEEDS_CORRECTIONS) {
            $document->update(['status' => DocumentStatus::STATUS_PROCESSING]);
        }
            
        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correcion fue verificada',
        ]);
    }
}
