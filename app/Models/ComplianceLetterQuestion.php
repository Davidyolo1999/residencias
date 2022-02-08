<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceLetterQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['is_fulfilled'];

    /**
     * Relationships
     */
    public function children()
    {
        return $this->hasMany(ComplianceLetterQuestion::class, 'parent_id');
    }
}
