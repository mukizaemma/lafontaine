<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReaderBookRead extends Model
{
    use HasFactory;
    protected $fillable = ['reader_id', 'book_id', 'read_at'];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
