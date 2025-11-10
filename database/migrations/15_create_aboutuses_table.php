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
        Schema::create('aboutuses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subTitle')->nullable();
            $table->text('headerImage')->nullable();
            $table->text('backImage')->nullable();
            $table->text('backImageText')->nullable();
            $table->longText('aboutus')->nullable();
            $table->longText('vision')->nullable();
            $table->longText('mission')->nullable();
            $table->longText('values')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutuses');
    }
};
