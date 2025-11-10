<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->text('publication')->nullable();
            $table->text('credits')->nullable();
            $table->string('language')->nullable();
            $table->unsignedInteger('ebook_number')->nullable();
            $table->date('release_date')->nullable();
            $table->unsignedInteger('downloads')->default(0);
            $table->unsignedInteger('reads')->default(0);
            $table->unsignedInteger('buyers')->default(0);
            $table->text('pdf_file')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('buy_url')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['Active', 'Inactive','Soldout'])->default('Active');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
