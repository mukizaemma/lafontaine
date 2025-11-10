<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table="guests";
    protected $fillable = [
        'names',
        'phone',
        'email',
        'occupation',
        'dob',
        'address',
        'description',
    ];

}
