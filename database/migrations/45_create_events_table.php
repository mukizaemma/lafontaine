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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('venue')->nullable();
            $table->string('fees')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Published', 'Unpublished'])->default('Unpublished');
            $table->string('published_by')->default('Kwizera Samuel');
            $table->dateTime('published_at')->nullable();
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
