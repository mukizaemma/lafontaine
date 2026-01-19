<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_stats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('value');
            $table->year('year');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_stats');
    }
};
