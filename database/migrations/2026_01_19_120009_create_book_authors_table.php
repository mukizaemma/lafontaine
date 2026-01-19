<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_authors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();
        });
        
        // Add foreign keys separately after table creation
        if (Schema::hasTable('books') && Schema::hasTable('authors')) {
            Schema::table('book_authors', function (Blueprint $table) {
                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
                $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('book_authors');
    }
};
