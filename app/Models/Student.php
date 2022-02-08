<?php

namespace App\Models;

use App\Enum\DocumentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    /**
     * Relationships
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function state()
    {
        return $this->belongsTo(Location::class, 'state_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Location::class, 'municipality_id');
    }

    public function locality()
    {
        return $this->belongsTo(Location::class, 'locality_id');
    }

    public function residencyRequest()
    {
        return $this->hasOne(ResidencyRequest::class, 'user_id')->withDefault();
    }

    public function inProcessResidencyRequest()
    {
        return $this->hasOne(ResidencyRequest::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedResidencyRequest()
    {
        return $this->hasOne(ResidencyRequest::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function presentationLetter()
    {
        return $this->hasOne(PresentationLetter::class, 'user_id')->withDefault();
    }

    public function inProcessPresentationLetter()
    {
        return $this->hasOne(PresentationLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedPresentationLetter()
    {
        return $this->hasOne(PresentationLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function commitmentLetter()
    {
        return $this->hasOne(CommitmentLetter::class, 'user_id')->withDefault();
    }

    public function inProcessCommitmentLetter()
    {
        return $this->hasOne(CommitmentLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedCommitmentLetter()
    {
        return $this->hasOne(CommitmentLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function acceptanceLetter()
    {
        return $this->hasOne(AcceptanceLetter::class, 'user_id')->withDefault();
    }

    public function inProcessAcceptanceLetter()
    {
        return $this->hasOne(AcceptanceLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedAcceptanceletter()
    {
        return $this->hasOne(AcceptanceLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function assignmentLetter()
    {
        return $this->hasOne(AssignmentLetter::class, 'user_id')->withDefault();
    }

    public function inProcessAssignmentLetter()
    {
        return $this->hasOne(AssignmentLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedAssignmentLetter()
    {
        return $this->hasOne(AssignmentLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function preliminaryLetter()
    {
        return $this->hasOne(PreliminaryLetter::class, 'user_id')->withDefault();
    }

    public function inProcessPreliminaryLetter()
    {
        return $this->hasOne(PreliminaryLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedPreliminaryLetter()
    {
        return $this->hasOne(PreliminaryLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function paperStructure()
    {
        return $this->hasOne(PaperStructure::class, 'user_id')->withDefault();
    }

    public function inProcessPaperStructure()
    {
        return $this->hasOne(PaperStructure::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedPaperStructure()
    {
        return $this->hasOne(PaperStructure::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function complianceLetter()
    {
        return $this->hasOne(ComplianceLetter::class, 'user_id')->withDefault();
    }
    
    public function inProcessComplianceLetter()
    {
        return $this->hasOne(ComplianceLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }

    public function approvedComplianceLetter()
    {
        return $this->hasOne(ComplianceLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function qualificationLetter()
    {
        return $this->hasOne(QualificationLetter::class, 'user_id')->withDefault();
    }

    public function inProcessQualificationLetter()
    {
        return $this->hasOne(QualificationLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }
    
    public function approvedQualificationLetter()
    {
        return $this->hasOne(QualificationLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function completionLetter()
    {
        return $this->hasOne(CompletionLetter::class, 'user_id')->withDefault();
    }

    public function inProcessCompletionLetter()
    {
        return $this->hasOne(CompletionLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }
    
    public function approvedCompletionLetter()
    {
        return $this->hasOne(CompletionLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function submissionLetter()
    {
        return $this->hasOne(SubmissionLetter::class, 'user_id')->withDefault();
    }

    public function inProcessSubmissionLetter()
    {
        return $this->hasOne(SubmissionLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_PROCESSING);
    }
    
    public function approvedSubmissionLetter()
    {
        return $this->hasOne(SubmissionLetter::class, 'user_id')->where('status', DocumentStatus::STATUS_APPROVED);
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function externalAdvisor()
    {
        return $this->belongsTo(ExternalAdvisor::class, 'external_advisor_id');
    }

    /**
     * Scopes
     */
    public function scopeWithEmail($query)
    {
        return $query
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('students.*')
            ->addSelect('users.email');
    }

    /**
     * Accessors
     */
    public function getSexTextAttribute()
    {
        return [
            'm' => 'Masculino',
            'f' => 'Femenino',
        ][$this->sex];
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->fathers_last_name} {$this->mothers_last_name}";
    }

    public function getPaddedIdAttribute()
    {
        return str_pad($this->user_id, 4, '0', STR_PAD_LEFT);
    }
}
