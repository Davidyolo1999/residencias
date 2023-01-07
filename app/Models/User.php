<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ADMIN_ROLE = 'admin';
    public const STUDENT_ROLE = 'student';
    public const TEACHER_ROLE = 'teacher';
    public const EXTERNAL_ADVISOR_ROLE = 'external_advisor';

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function externalAdvisor()
    {
        return $this->hasOne(ExternalAdvisor::class);
    }

    /**
     * Scopes
     */
    public function scopeIsAdmin($query)
    {
        return $query->where('role', self::ADMIN_ROLE);
    }

    public function scopeIsStudent($query)
    {
        return $query->where('role', self::STUDENT_ROLE);
    }

    /**
     * Methods
     */
    public function isStudent()
    {
        return $this->role === self::STUDENT_ROLE;
    }

    public function isTeacher()
    {
        return $this->role === self::TEACHER_ROLE;
    }

    public function isExternalAdvisor()
    {
        return $this->role === self::EXTERNAL_ADVISOR_ROLE;
    }

    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }
}
