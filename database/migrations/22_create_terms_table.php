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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->longText('privacy')->nullable();           
            $table->longText('return')->nullable();           
            $table->longText('terms')->nullable();           
            $table->longText('support')->nullable();       

            $table->unsignedBigInteger("added_by")->comment("Id of User Instance");
            $table->foreign("added_by")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
