<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading', 'subHeading', 'hero_title', 'hero_subtitle', 'hero_description',
        'hero_button_text_1', 'hero_button_link_1', 'hero_button_text_2', 'hero_button_link_2',
        'about_stream_title', 'about_stream_content',
        'vision_title', 'vision_content', 'mission_title', 'mission_content',
        'why_french_title', 'why_french_subtitle', 'why_french_points', 'why_french_benefits',
        'linguistic_title', 'linguistic_programs', 'linguistic_publications',
        'linguistic_training', 'linguistic_exchange', 'linguistic_events',
        'methodology_title', 'methodology_content', 'methodology_points',
        'impact_section_title', 'impact_stats',
        'sustainability_title', 'sustainability_content', 'sustainability_points',
        'partnership_title', 'partnership_content', 'partnership_benefits',
        'welcomeImage', 'welcomeVideo', 'problem', 'solution',
        'workBackImage', 'workQuote', 'videoUrl',
        'impactTitle', 'impactQuote', 'impactImmage',
        'user_id'
    ];

    protected $casts = [
        'why_french_points' => 'array',
        'why_french_benefits' => 'array',
        'linguistic_programs' => 'array',
        'linguistic_publications' => 'array',
        'linguistic_training' => 'array',
        'linguistic_exchange' => 'array',
        'linguistic_events' => 'array',
        'methodology_points' => 'array',
        'impact_stats' => 'array',
        'sustainability_points' => 'array',
        'partnership_benefits' => 'array',
    ];
}
