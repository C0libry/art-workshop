<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\User;
use \App\Models\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => 'admin',
        ]);

        Room::factory()->create([
            'address' => 'Гоголя',
            'name' => 'Аудитория №1',
            'description' => '',
            'image' => 'uploads/public/images/rooms/room1.jpg',
        ]);
        Room::factory()->create([
            'address' => 'Курчатова',
            'name' => 'Аудитория №2',
            'description' => 'Площадь: 20',
            'image' => 'uploads/public/images/rooms/room2.jpg',
        ]);
        Room::factory()->create([
            'address' => 'Курчатова',
            'name' => 'Аудитория №3',
            'description' => 'Площадь: 40',
            'image' => 'uploads/public/images/rooms/room2.jpg',
        ]);
        Room::factory()->create([
            'address' => 'Голандия',
            'name' => 'Аудитория №4',
            'description' => 'Площадь: 20',
            'image' => 'uploads/public/images/rooms/room1.jpg',
        ]);
        Room::factory()->create([
            'address' => 'Голандия',
            'name' => 'Аудитория №5',
            'description' => 'Площадь: 30',
            'image' => 'uploads/public/images/rooms/room2.jpg',
        ]);
    }
}
