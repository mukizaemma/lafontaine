<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_requests', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->enum('partnership_type', ['School', 'University', 'NGO', 'Embassy', 'Investor']);
            $table->text('message');
            $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected'])->default('pending');
            $table->text('admin_feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_requests');
    }
};
