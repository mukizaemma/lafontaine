<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $table='stories';

    protected $fillable = [
        'title',
        'slug',
        'names',
        'position',
        'image',
        'status',
        'user_id',
        'program_id',
        'project_id',
        'description',
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }
}
