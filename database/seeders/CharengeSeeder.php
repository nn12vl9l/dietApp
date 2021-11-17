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
                'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fmg.runtrip.jp%2Farchives%2F55126&psig=AOvVaw0TKfbPpc7LaOrYJB2uY4LP&ust=1637212090153000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCMj2y7rQnvQCFQAAAAAdAAAAABAD',
                'limit_data' => '2021/12/31',
                'created_at' => '2021/11/17',
            ],
        ]);
    }
}
