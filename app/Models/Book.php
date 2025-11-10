<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table='books';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'status',
        'author',
        'category',
        'publication',
        'credits',
        'language',
        'ebook_number',
        'release_date',
        'downloads',
        'reads',
        'buyers',
        'pdf_file',
        'cover_image',
        'buy_url',
        'status',
        'status',
        'user_id',
        'category_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Bookcomment::class);
    }

    public function readingRecords()
    {
        return $this->hasMany(ReaderBookRead::class);
    }

    public function readers()
    {
        return $this->belongsToMany(Reader::class, 'reader_books')
                    ->withPivot('times_read', 'downloaded')
                    ->withTimestamps();
    }

    public function readerBooks()
    {
        return $this->belongsToMany(Reader::class, 'reader_books', 'book_id', 'reader_id')
                    ->withPivot('times_read'); // Ensure the pivot table also has the 'times_read' column
    }
}
