<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1; 

        DB::table('settings')->insert([
            'title' => 'La Claire Fontaine',
            'company' => 'La Claire Fontaine',
            'address' => 'Kigali Kicukiro',
            'phone' => '+250 783 168 164',
            'email' => 'info@La Claire Fontaine.org',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'youtube' => 'https://youtube.com',
            'linkedin' => 'https://linkedin.com',
            'linktree' => 'https://linktree.com',
            'donate' => 'Please donate to support us.',
            'logo' => 'path/to/default/logo.png',
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
