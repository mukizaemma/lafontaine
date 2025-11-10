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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->text('subHeading')->nullable();
            $table->text('welcomeImage')->nullable();
            $table->text('welcomeVideo')->nullable();
            $table->longText('problem')->nullable();
            $table->longText('solution')->nullable();
            $table->string('workBackImage')->nullable();
            $table->longText('workQuote')->nullable();
            $table->string('videoUrl')->nullable();
            $table->string('impactTitle')->nullable();
            $table->longText('impactQuote')->nullable();
            $table->string('impactImmage')->nullable();

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
        Schema::dropIfExists('homes');
    }
};
