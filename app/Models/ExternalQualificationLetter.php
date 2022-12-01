<?php

namespace App\Models;

use App\Models\Traits\ResidencyProcessDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalQualificationLetter extends Model
{
    use HasFactory, ResidencyProcessDocument;

    public const RESPONSE_TYPE = ['excelente', 'bueno', 'regular', 'malo', 'deficiente'];

    protected $guarded = [];

    protected $dates = ['request_date'];
}
