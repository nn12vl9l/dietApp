<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('charenges')->insert([
            [
                'user_id' => 1,
                'title' => 'Youtubeで筋トレ',
                'body' => '継続は力なり。3分でも5分でもやってみよう！',
                'image' => '20211117215926_8.jpg',
                'limit_data' => '2021/12/31',
            ],
        ]);
    }
}
