<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//add to seed pages
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
            'name' => 'Php error',
            'user_id' => 1,
            'board_id' => 1,
            'helper_id' => 3,
            'description' => 'geen beschrijving',
            'status' => 'finished',
            'updated_at' => '2022-01-27 10:52:24'
        ]);
        DB::table('cards')->insert([
            'name' => 'laravel error',
            'user_id' => 1,
            'board_id' => 1,
            'helper_id' => 3,
            'description' => 'geen beschrijving',
            'status' => 'finished',
            'updated_at' => '2022-02-27 12:52:24'
        ]);
        DB::table('cards')->insert([
            'name' => 'js error',
            'user_id' => 1,
            'board_id' => 1,
            'helper_id' => 3,
            'description' => 'geen beschrijving',
            'status' => 'finished',
            'updated_at' => '2022-03-27 15:52:24'
        ]);
        DB::table('cards')->insert([
            'name' => 'css error',
            'user_id' => 1,
            'board_id' => 1,
            'helper_id' => 3,
            'description' => 'geen beschrijving',
            'status' => 'finished',
            'updated_at' => '2022-01-27 11:52:24'
        ]);
    }
}
