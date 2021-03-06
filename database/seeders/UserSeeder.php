<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//add to seed pages
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin-account',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'user_role_id' => '3'
        ]);

        DB::table('users')->insert([
            'name' => 'admin2-account',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password'),
            'user_role_id' => '3'
        ]);

        DB::table('users')->insert([
            'name' => 'teacher-account',
            'email' => 'teacher@teacher.com',
            'password' => Hash::make('password'),
            'user_role_id' => '2'
        ]);

        DB::table('users')->insert([
            'name' => 'student-account',
            'email' => 'student@student.com',
            'password' => Hash::make('password'),
            'user_role_id' => '1'
        ]);
        // User::factory()->count(19)->create();
    }
}
