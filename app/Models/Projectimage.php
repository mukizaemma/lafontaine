<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectimage extends Model
{
    use HasFactory;
    protected $table='projectimages';

    protected $fillable = [
        'caption',
        'image',
        'user_id',
        'program_id',
    ];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
