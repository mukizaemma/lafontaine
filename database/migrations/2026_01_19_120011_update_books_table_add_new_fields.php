<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('books')) {
            return;
        }
        
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'isbn')) {
                $table->string('isbn')->nullable()->after('language');
            }
            if (!Schema::hasColumn('books', 'file_url')) {
                $table->string('file_url')->nullable()->after('pdf_file');
            }
            if (!Schema::hasColumn('books', 'published_year')) {
                $table->year('published_year')->nullable()->after('release_date');
            }
            if (!Schema::hasColumn('books', 'level')) {
                $table->enum('level', ['Beginner', 'Intermediate', 'Advanced'])->nullable()->after('category');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('books')) {
            return;
        }
        
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'isbn')) {
                $table->dropColumn('isbn');
            }
            if (Schema::hasColumn('books', 'file_url')) {
                $table->dropColumn('file_url');
            }
            if (Schema::hasColumn('books', 'published_year')) {
                $table->dropColumn('published_year');
            }
            if (Schema::hasColumn('books', 'level')) {
                $table->dropColumn('level');
            }
        });
    }
};
