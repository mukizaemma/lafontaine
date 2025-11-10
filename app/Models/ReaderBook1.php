<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReaderBook extends Model
{
    use HasFactory;
    protected $fillable = ['reader_id', 'book_id', 'times_read'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
