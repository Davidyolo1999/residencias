<?php

namespace App\Models;

use App\Models\Traits\ResidencyProcessDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceLetter extends Model
{
    use HasFactory, ResidencyProcessDocument;

    protected $guarded = [];

    protected $dates = ['request_date'];

    /**
     * Relationships
     */
    public function questions()
    {
        return $this->hasMany(ComplianceLetterQuestion::class);
    }

    public function parentQuestions()
    {
        return $this->questions()->whereNull('parent_id');
    }
}
