<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\TopicSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            "name" => "YoKYa",
            "email" => "yokya@yokya.id",
            "password" => bcrypt("password"),
            "roles" => 'superadmin'
        ]);
        $this->call(TopicSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
