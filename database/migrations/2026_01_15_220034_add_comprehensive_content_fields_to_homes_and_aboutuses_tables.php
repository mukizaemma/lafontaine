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
        // Add fields to homes table for homepage content
        Schema::table('homes', function (Blueprint $table) {
            // Hero Section
            $table->text('hero_title')->nullable()->after('heading');
            $table->text('hero_subtitle')->nullable()->after('hero_title');
            $table->text('hero_description')->nullable()->after('hero_subtitle');
            $table->text('hero_button_text_1')->nullable()->after('hero_description');
            $table->text('hero_button_link_1')->nullable()->after('hero_button_text_1');
            $table->text('hero_button_text_2')->nullable()->after('hero_button_link_1');
            $table->text('hero_button_link_2')->nullable()->after('hero_button_text_2');
            
            // About French Stream Section
            $table->string('about_stream_title')->nullable()->after('hero_button_link_2');
            $table->longText('about_stream_content')->nullable()->after('about_stream_title');
            
            // Vision & Mission
            $table->string('vision_title')->nullable()->after('about_stream_content');
            $table->longText('vision_content')->nullable()->after('vision_title');
            $table->string('mission_title')->nullable()->after('vision_content');
            $table->longText('mission_content')->nullable()->after('mission_title');
            
            // Why French Section
            $table->string('why_french_title')->nullable()->after('mission_content');
            $table->longText('why_french_subtitle')->nullable()->after('why_french_title');
            $table->longText('why_french_points')->nullable()->after('why_french_subtitle'); // JSON array
            $table->longText('why_french_benefits')->nullable()->after('why_french_points'); // JSON array
            
            // Linguistic Offer
            $table->string('linguistic_title')->nullable()->after('why_french_benefits');
            $table->longText('linguistic_programs')->nullable()->after('linguistic_title'); // JSON
            $table->longText('linguistic_publications')->nullable()->after('linguistic_programs'); // JSON
            $table->longText('linguistic_training')->nullable()->after('linguistic_publications'); // JSON
            $table->longText('linguistic_exchange')->nullable()->after('linguistic_training'); // JSON
            $table->longText('linguistic_events')->nullable()->after('linguistic_exchange'); // JSON
            
            // Methodology
            $table->string('methodology_title')->nullable()->after('linguistic_events');
            $table->longText('methodology_content')->nullable()->after('methodology_title');
            $table->longText('methodology_points')->nullable()->after('methodology_content'); // JSON
            
            // Impact Section
            $table->string('impact_section_title')->nullable()->after('methodology_points');
            $table->longText('impact_stats')->nullable()->after('impact_section_title'); // JSON array of {title, value, description}
            
            // Sustainability & Growth
            $table->string('sustainability_title')->nullable()->after('impact_stats');
            $table->longText('sustainability_content')->nullable()->after('sustainability_title');
            $table->longText('sustainability_points')->nullable()->after('sustainability_content'); // JSON
            
            // Partnership Section
            $table->string('partnership_title')->nullable()->after('sustainability_points');
            $table->longText('partnership_content')->nullable()->after('partnership_title');
            $table->longText('partnership_benefits')->nullable()->after('partnership_content'); // JSON
        });

        // Add fields to aboutuses table for about page content
        Schema::table('aboutuses', function (Blueprint $table) {
            // Company Identity
            $table->longText('company_identity')->nullable()->after('values'); // JSON array of identity points
            
            // Education Streams
            $table->string('streams_title')->nullable()->after('company_identity');
            $table->longText('education_streams')->nullable()->after('streams_title'); // JSON array
            
            // Experience & Achievements
            $table->string('experience_title')->nullable()->after('education_streams');
            $table->longText('experience_content')->nullable()->after('experience_title');
            $table->longText('achievements')->nullable()->after('experience_content'); // JSON array
            
            // Contact Information (additional)
            $table->string('phone_1')->nullable()->after('achievements');
            $table->string('phone_2')->nullable()->after('phone_1');
            $table->string('phone_3')->nullable()->after('phone_2');
            $table->string('phone_4')->nullable()->after('phone_3');
            $table->string('website')->nullable()->after('phone_4');
        });

        // Add fields to settings table for contact and additional info
        Schema::table('settings', function (Blueprint $table) {
            $table->string('phone_2')->nullable()->after('phone');
            $table->string('phone_3')->nullable()->after('phone_2');
            $table->string('phone_4')->nullable()->after('phone_3');
            $table->string('website')->nullable()->after('phone_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title', 'hero_subtitle', 'hero_description',
                'hero_button_text_1', 'hero_button_link_1',
                'hero_button_text_2', 'hero_button_link_2',
                'about_stream_title', 'about_stream_content',
                'vision_title', 'vision_content',
                'mission_title', 'mission_content',
                'why_french_title', 'why_french_subtitle', 'why_french_points', 'why_french_benefits',
                'linguistic_title', 'linguistic_programs', 'linguistic_publications',
                'linguistic_training', 'linguistic_exchange', 'linguistic_events',
                'methodology_title', 'methodology_content', 'methodology_points',
                'impact_section_title', 'impact_stats',
                'sustainability_title', 'sustainability_content', 'sustainability_points',
                'partnership_title', 'partnership_content', 'partnership_benefits'
            ]);
        });

        Schema::table('aboutuses', function (Blueprint $table) {
            $table->dropColumn([
                'company_identity', 'streams_title', 'education_streams',
                'experience_title', 'experience_content', 'achievements',
                'phone_1', 'phone_2', 'phone_3', 'phone_4', 'website'
            ]);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['phone_2', 'phone_3', 'phone_4', 'website']);
        });
    }
};
