<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table='projects';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'problem',
        'solution',
        'image',
        'status',
        'user_id',
        'program_id',
        'backImage',
        'videoImage',
        'videoText',
    ];

    public function programs(){
        return $this->belongsTo(Program::class);
    }

    public function images(){
        return $this->hasMany(Projectimage::class);
    }
}
