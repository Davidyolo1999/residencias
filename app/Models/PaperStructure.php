<?php

namespace App\Models;

use App\Models\Traits\ResidencyProcessDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperStructure extends Model
{
    use HasFactory, ResidencyProcessDocument;

    protected $guarded = [];

}
