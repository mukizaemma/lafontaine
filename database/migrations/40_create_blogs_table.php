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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Published', 'Unpublished'])->default('Unpublished');
            $table->string('published_by')->default('La Claire Fontaine');
            $table->dateTime('published_at')->nullable();
            $table->string('summary', 255)->nullable();  // optional
        
            $table->unsignedBigInteger('views')->default(0);  // optional
            $table->unsignedBigInteger('likes')->default(0);  // optional
            $table->unsignedBigInteger('likes_count')->default(0);  // optional
        
            $table->unsignedBigInteger("added_by")->comment("Id of User Instance")->nullable();
            $table->foreign("added_by")->references("id")->on("users")->onDelete("cascade");
        
            $table->unsignedBigInteger("category_id")->comment("Id of Category Instance");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
