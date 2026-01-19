<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'level',
        'description',
        'duration',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

    public function pendingRegistrations()
    {
        return $this->hasMany(CourseRegistration::class)->where('status', 'pending');
    }

    public function approvedRegistrations()
    {
        return $this->hasMany(CourseRegistration::class)->where('status', 'approved');
    }
}
