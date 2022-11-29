<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProgress extends Model
{
    use HasFactory;


    /**
     * Relationships
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
