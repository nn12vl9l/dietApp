<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'entry_id' => 1,
                'image' => '20211118103709_23.jpg',
                'likes_count' => 0,
                'body' => 'スクワット10回×5セット、足上げ腹筋20回×3セット',
                'weight_kg' => 55,
                'intake_kcal' => 1400,
                'consume_kcal' => 1300,
            ],
        ]);
    }
}
