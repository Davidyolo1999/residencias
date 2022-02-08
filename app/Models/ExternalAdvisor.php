<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalAdvisor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scopes
     */
    public function scopeWithEmail($query)
    {
        return $query
            ->join('users', 'external_advisors.user_id', '=', 'users.id')
            ->select('external_advisors.*')
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
}

