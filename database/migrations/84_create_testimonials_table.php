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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('names')->nullable();
            $table->unsignedBigInteger("added_by");
            $table->longText('testimony')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->boolean('display')->default(true);
            $table->string('slug');

            $table->unsignedBigInteger("program_id")->nullable();
            $table->foreign("added_by")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("program_id")->references("id")->on("programs")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
