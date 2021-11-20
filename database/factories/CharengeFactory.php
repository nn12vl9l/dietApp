<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CharengeFactory extends Factory
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
            'user_id' => \App\Models\User::factory()->create(),
            'title' => $this->faker->realText(8),
            'body' => $this->faker->realText(30),
            'image' => basename($path),
            'limit_data' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+4 week'),
        ];
    }
}
