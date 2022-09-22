<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ResidencyProcessDocument;

class AuthorizationLetter extends Model
{
    use HasFactory, ResidencyProcessDocument;

    protected $guarded = [];

    protected $dates = ['request_date'];
}
