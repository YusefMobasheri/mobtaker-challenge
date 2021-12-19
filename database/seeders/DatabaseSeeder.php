<?php

namespace Database\Seeders;

use App\Mappers\UserTypeMapper;
use App\Models\Lesson;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        School::factory(2)->create();
        User::updateOrCreate(['email' => 'superadmin@edu.com'], [
            'name' => 'Super Admin',
            'email' => 'superadmin@edu.com',
            'email_verified_at' => now(),
            'password' => bcrypt('111222333'), // password
            'remember_token' => Str::random(10),
            'type' => UserTypeMapper::SUPER_ADMIN,
            'school_id' => School::first()->id,
        ]);
        User::factory(15)->create();

        Lesson::factory(15)->create();
    }
}
