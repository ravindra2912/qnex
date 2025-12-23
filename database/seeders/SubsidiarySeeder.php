<?php

namespace Database\Seeders;

use App\Models\Subsidiary;
use Illuminate\Database\Seeder;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subsidiaries = [
            [
                'name' => 'Qnex Manufacturing',
                'description' => 'Leading the way in electronic components manufacturing with state-of-the-art facilities and ISO 9001:2015 certified processes.',
            ],
            [
                'name' => 'Qnex Logistics',
                'description' => 'Providing top-notch logistics and supply chain solutions for seamless operations across India with same-day dispatch services.',
            ],
            [
                'name' => 'Qnex R&D Labs',
                'description' => 'Innovating for the future with advanced R&D and technical support services, ensuring quality and reliability in every product.',
            ],
            [
                'name' => 'Qnex Solutions',
                'description' => 'Dedicated to providing comprehensive technical support and customer service solutions for all AC spare parts needs.',
            ],
        ];

        foreach ($subsidiaries as $subsidiaryData) {
            // Generate a random color avatar for the logo
            $imageUrl = "https://ui-avatars.com/api/?name=" . urlencode($subsidiaryData['name']) . "&background=random&size=300&color=fff";

            // Download image to temp file
            $tempPath = sys_get_temp_dir() . '/' . \Illuminate\Support\Str::random(10) . '.png';

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
                    'subsidiary.png',
                    'image/png',
                    null,
                    true
                );

                // Use specific size for subsidiary images (300x300)
                $uploadPath = fileUploadStorage($file, 'subsidiary_images', 300, 300);
            }

            Subsidiary::create([
                'image' => $uploadPath,
                'name' => $subsidiaryData['name'],
                'description' => $subsidiaryData['description'],
                'status' => 'active',
            ]);
        }
    }
}
