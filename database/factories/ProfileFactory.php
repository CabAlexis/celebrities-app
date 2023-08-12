<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = fake()->image();
        $imageFile = new File($image);


        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'image' => Storage::put('public/images', $imageFile),
            'description' => $this->faker->text
        ];
    }
}
