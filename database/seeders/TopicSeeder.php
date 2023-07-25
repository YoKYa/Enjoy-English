<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'My Classmates','svg' => 'svg/classmates.svg'],
            ['name' => 'I Love My Family','svg' => 'svg/family.svg'],
            ['name' => 'Culture','svg' => 'svg/culture.svg'],
            ['name' => 'Showing Direction','svg' => 'svg/direction.svg'],
            ['name' => 'Hobbies','svg' => 'svg/study.svg'],
            ['name' => 'My Dream Job','svg' => 'svg/job.svg'],
            ['name' => 'Describing Time and Date','svg' => 'svg/clock.svg'],
            ['name' => 'Can Help Me?','svg' => '/svg/Conversation.svg'],
            ['name' => 'Holiday/Vacation','svg' => 'svg/beach.svg'],
        ];
        Topic::insert($data);
    }
}
