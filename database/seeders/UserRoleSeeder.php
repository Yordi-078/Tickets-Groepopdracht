<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'role' => 'student',
        ]);

        DB::table('user_roles')->insert([
            'role' => 'teacher',
        ]);

        DB::table('user_roles')->insert([
            'role' => 'admin',
        ]);
    }
}
