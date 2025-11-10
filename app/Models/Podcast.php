<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    protected $table='podcasts';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'status',
        'publish',
        'guest',
        'host',
        'audio_url',
        'video_url',
        'downloads',
        'likes',
        'views',
        'podcastcategory_id',
        'published_at',
        'published_by',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function podcastCategory()
    {
        return $this->belongsTo(Podcastcategory::class, 'podcastcategory_id');
    }
}
