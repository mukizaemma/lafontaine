<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Str;

class CoursesProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create a default one
        $user = User::where('role', 'admin')->first();
        if (!$user) {
            $user = User::first();
        }

        // Create 3 Courses
        $courses = [
            [
                'title' => 'French for Beginners',
                'category' => 'Language Learning',
                'level' => 'Beginner',
                'description' => 'Start your French language journey with this comprehensive beginner course. Learn basic vocabulary, grammar, and conversational skills. Perfect for those who have never studied French before.',
                'duration' => '12 weeks',
                'price' => 299.00,
                'status' => 'active',
            ],
            [
                'title' => 'Intermediate French Conversation',
                'category' => 'Language Learning',
                'level' => 'Intermediate',
                'description' => 'Enhance your French speaking skills with this intermediate conversation course. Focus on fluency, pronunciation, and real-world communication scenarios. Build confidence in everyday French conversations.',
                'duration' => '10 weeks',
                'price' => 349.00,
                'status' => 'active',
            ],
            [
                'title' => 'Advanced French Literature',
                'category' => 'Literature',
                'level' => 'Advanced',
                'description' => 'Explore the rich world of French literature with this advanced course. Study classic and contemporary French authors, analyze literary techniques, and develop critical thinking skills in French.',
                'duration' => '14 weeks',
                'price' => 399.00,
                'status' => 'active',
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        // Create 3 Programs
        $programs = [
            [
                'title' => 'Youth Empowerment Program',
                'slug' => Str::slug('Youth Empowerment Program'),
                'description' => '<p>Our Youth Empowerment Program is designed to inspire and equip young people with essential life skills, leadership abilities, and French language proficiency. Through interactive workshops, mentorship, and community engagement, participants develop confidence and prepare for future opportunities.</p><p>The program includes:</p><ul><li>Leadership training workshops</li><li>French language immersion</li><li>Career development sessions</li><li>Community service projects</li><li>Networking opportunities</li></ul>',
                'image' => null,
                'status' => 'active',
                'user_id' => $user ? $user->id : 1,
            ],
            [
                'title' => 'Women\'s Education Initiative',
                'slug' => Str::slug('Women\'s Education Initiative'),
                'description' => '<p>The Women\'s Education Initiative focuses on empowering women through education, skill development, and French language learning. This program creates a supportive environment where women can grow, learn, and achieve their goals.</p><p>Program features:</p><ul><li>French language classes tailored for women</li><li>Professional development workshops</li><li>Entrepreneurship training</li><li>Peer support groups</li><li>Access to educational resources</li></ul>',
                'image' => null,
                'status' => 'active',
                'user_id' => $user ? $user->id : 1,
            ],
            [
                'title' => 'Community French Learning Hub',
                'slug' => Str::slug('Community French Learning Hub'),
                'description' => '<p>Our Community French Learning Hub brings together learners of all ages and backgrounds to practice French in a welcoming, community-centered environment. This program emphasizes practical communication skills and cultural understanding.</p><p>What you\'ll experience:</p><ul><li>Group learning sessions</li><li>Cultural exchange activities</li><li>French conversation practice</li><li>Cultural events and celebrations</li><li>Access to learning materials</li></ul>',
                'image' => null,
                'status' => 'active',
                'user_id' => $user ? $user->id : 1,
            ],
        ];

        foreach ($programs as $programData) {
            Program::create($programData);
        }

        $this->command->info('Successfully seeded 3 courses and 3 programs!');
    }
}
