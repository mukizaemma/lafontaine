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
        Schema::create('getinvolveds', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subTitle')->nullable();
            $table->text('headerImage')->nullable();
            $table->longText('quote')->nullable();
            $table->longText('voluteer')->nullable();
            $table->longText('partner')->nullable();
            $table->longText('give')->nullable();
            $table->text('videoBack')->nullable();
            $table->text('videoUrl')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('getinvolveds');
    }
};
