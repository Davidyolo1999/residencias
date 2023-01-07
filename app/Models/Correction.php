<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_solved' => 'bool',
    ];

    /**
     * Relationships
     */
    public function correctionable()
    {
        return $this->morphTo();
    }
}
