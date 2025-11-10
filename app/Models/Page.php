<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = "pages";

    protected $fillable = [
        'cpage_idption',
        'user_id',
        'title',
        'description',
        'image',
    ];

    function images(){
        return $this->hasMany(PageImage::class);
    }
}
