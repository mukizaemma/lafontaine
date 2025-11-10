<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;
        protected $table = "readers";

    protected $fillable = [
        'email','status'
    ];

    public function readingHistory()
    {
        return $this->hasMany(ReaderBookRead::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'reader_books')
                    ->withPivot('times_read', 'downloaded')
                    ->withTimestamps();
    }
}
