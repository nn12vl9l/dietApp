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
                'charenge_id' => 1,
                'image' => '20211118134521_7.jpg',
                'body' => '頑張りました',
                'weight_kg' => 55.6,
                'walk' => 3800,
                'post_day' => '2021/11/22',
            ],
        ]);
    }
}
