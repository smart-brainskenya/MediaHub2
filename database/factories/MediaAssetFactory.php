<?php

namespace Database\Factories;

use App\Models\MediaAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaAsset>
 */
class MediaAssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MediaAsset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['image', 'video']);

        if ($type === 'image') {
            $filePath = $this->faker->slug() . '.jpg';
            $mimeType = 'image/jpeg';
        } else {
            $filePath = $this->faker->slug() . '.mp4';
            $mimeType = 'video/mp4';
        }

        return [
            'name' => $this->faker->sentence(3),
            'type' => $type,
            'file_path' => $filePath,
            'mime_type' => $mimeType,
        ];
    }
}
