<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 画像サイズを指定
        $width = 500;
        $height = 300;

        // 画像を保存してpathを取得
        $file = $this->faker->image(null, $width, $height);
        $path = Storage::putFile('posts', $file);
        File::delete($file);

        return [
            'charenge_id' => \App\Models\Charenge::Factory()->create(),
            'user_id' => \App\Models\User::factory()->create(),
            'image' => basename($path),
            'body' => $this->faker->realText(30),
            'weight_kg' => $this->faker->numberBetween(60, 100),
            'intake_kcal' => $this->faker->numberBetween(1000, 2000),
            'consume_kcal' => $this->faker->numberBetween(1000, 1800),
            'post_day' => $this->faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        ];
    }
}
