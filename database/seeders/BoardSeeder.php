<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//add to seed pages
use Illuminate\Support\Facades\DB;

use App\Models\Board;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->insert([
            'name' => 'Programmeren',
            'madeby_id' => 1,
            'description' => 'Programeer groep voor vragen en lessen',
        ]);
        DB::table('board_user')->insert([
            'board_id' => 1,
            'user_id' => 1,
        ]);

        
        // Board::factory()->count(20)->create();
    }
}
