<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'subject_code' => 'MATH101',
                'subject_name' => 'Mathematics',
                'description' => 'Fundamental operations, algebra, and problem-solving skills.',
            ],
            [
                'subject_code' => 'ENG101',
                'subject_name' => 'English',
                'description' => 'Grammar, reading comprehension, and effective communication skills.',
            ],
            [
                'subject_code' => 'FIL101',
                'subject_name' => 'Filipino',
                'description' => 'Wika, pagbasa, at pagpapahalaga sa panitikang Pilipino.',
            ],
            [
                'subject_code' => 'SCI101',
                'subject_name' => 'Science',
                'description' => 'Introduction to earth science, biology, chemistry, and physics concepts.',
            ],
        ];

        foreach ($subjects as $subject) {
            // Using updateOrCreate avoids duplicate records if you run it multiple times
            Subject::updateOrCreate(
                ['subject_code' => $subject['subject_code']],
                [
                    'subject_name' => $subject['subject_name'],
                    'description' => $subject['description'],
                ]
            );
        }
    }
}