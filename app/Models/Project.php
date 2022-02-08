<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    protected $dates = ['start_date', 'end_date'];
    
    /**
     * Relationships
     */
    public function specificObjectives()
    {
        return $this->hasMany(SpecificObjective::class);
    }
    
    /**
     * Accessors
     */
    public function getActivityScheduleImageUrlAttribute()
    {
        return Storage::url($this->attributes['activity_schedule_image']);
    }

    public function getStartDateFormattedAttribute()
    {
        return "{$this->start_date->day} de {$this->start_date->monthName} de {$this->start_date->year}";
    }

    public function getEndDateFormattedAttribute()
    {
        return "{$this->end_date->day} de {$this->end_date->monthName} de {$this->end_date->year}";
    }
}
