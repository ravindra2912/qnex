<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 8; $i++) {
            // Use loremflickr to get a random person image
            $random = rand(1, 1000);
            $imageUrl = "https://loremflickr.com/500/500/person/all?random={$random}";

            // Download image to temp file
            $tempPath = sys_get_temp_dir() . '/' . \Illuminate\Support\Str::random(10) . '.jpg';

            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // Attempt to fetch image
            $imageContent = @file_get_contents($imageUrl, false, stream_context_create($arrContextOptions));

            $uploadPath = null;
            if ($imageContent !== false) {
                file_put_contents($tempPath, $imageContent);

                $file = new \Illuminate\Http\UploadedFile(
                    $tempPath,
                    'testimonial.jpg',
                    'image/jpeg',
                    null,
                    true
                );

                $uploadPath = fileUploadStorage($file, 'testimonial_images', 500, 500);
            }

            Testimonial::create([
                'image' => $uploadPath,
                'name' => $faker->name,
                'designation' => $faker->jobTitle,
                'review' => $faker->paragraph,
                'rating' => rand(4, 5),
                'status' => 'active',
            ]);
        }
    }
}
