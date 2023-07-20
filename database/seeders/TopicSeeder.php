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
            ['name' => 'My Classmates','svg' => 'svg/classmates.svg', 'slug'=> Str::slug('My Classmates')],
            ['name' => 'I Love My Family','svg' => 'svg/family.svg', 'slug'=> Str::slug('I Love My Family')],
            ['name' => 'Culture','svg' => 'svg/culture.svg', 'slug'=> Str::slug('Culture')],
            ['name' => 'Showing Direction','svg' => 'svg/direction.svg', 'slug'=> Str::slug('Showing Direction')],
            ['name' => 'Hobbies','svg' => 'svg/study.svg', 'slug'=> Str::slug('Hobbies')],
            ['name' => 'My Dream Job','svg' => 'svg/job.svg', 'slug'=> Str::slug('My Dream Job')],
            ['name' => 'Describing Time and Date','svg' => 'svg/clock.svg', 'slug'=> Str::slug('Describing Time and Date')],
            ['name' => 'Can Help Me?','svg' => '/svg/Conversation.svg', 'slug'=> Str::slug('Can Help Me?')],
            ['name' => 'Holiday/Vacation','svg' => 'svg/beach.svg', 'slug'=> Str::slug('Holiday/Vacation')],
        ];
        Topic::insert($data);
    }
}
