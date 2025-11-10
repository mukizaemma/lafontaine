<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;
    protected $table = "page_images";

    protected $fillable = [
        'page_id',
        'user_id',
        'image',
        'caption',
    ];

    function page(){
        $this->belongsTo(Page::class);
    }
}
