<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcastcategory extends Model
{
    use HasFactory;
    protected $table = 'podcastcategories';

    protected $fillable = ['title', 'description', 'slug', 'image'];


    public function podcasts(){
       return $this->hasMany(Podcast::class);
    }
}
