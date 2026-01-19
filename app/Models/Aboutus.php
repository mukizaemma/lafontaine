<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subTitle', 'headerImage', 'backImage', 'backImageText',
        'aboutus', 'vision', 'mission', 'values',
        'company_identity', 'streams_title', 'education_streams',
        'experience_title', 'experience_content', 'achievements',
        'phone_1', 'phone_2', 'phone_3', 'phone_4', 'website'
    ];

    protected $casts = [
        'company_identity' => 'array',
        'education_streams' => 'array',
        'achievements' => 'array',
    ];
}
