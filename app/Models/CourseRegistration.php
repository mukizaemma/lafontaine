<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'full_name',
        'email',
        'phone',
        'country',
        'motivation',
        'status',
        'admin_comment',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
