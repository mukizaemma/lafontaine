<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';

    protected $fillable = [
        'names',
        'position',
        'department',
        'description',
        'image',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'website',
        'linkedin',
        'display',
        'status',
        'slug'
    ];
}
