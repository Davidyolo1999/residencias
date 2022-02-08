<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relations
     */
    public function locations()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    /**
     * Scopes
     */
    public function scopeState($query)
    {
        return $query->whereNull('parent_id');
    }
}
