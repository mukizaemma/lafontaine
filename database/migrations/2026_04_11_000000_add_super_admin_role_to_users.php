<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','editor','guest','super_admin') NOT NULL DEFAULT 'guest'");

        DB::table('users')
            ->where('email', 'admin@iremetech.com')
            ->update(['role' => 'super_admin']);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('role', 'super_admin')
            ->update(['role' => 'admin']);

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','editor','guest') NOT NULL DEFAULT 'guest'");
    }
};
