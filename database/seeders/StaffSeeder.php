<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffImages = [
            'team-img1.png',
            'team-img2.png',
            'team-img3.png',
        ];

        $staffData = [
            [
                'name' => 'John Doe',
                'position' => 'CEO',
                'facebook_url' => 'https://facebook.com/johndoe',
                'linkedin_url' => 'https://linkedin.com/in/johndoe',
                'x_url' => 'https://x.com/johndoe',
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'CTO',
                'facebook_url' => 'https://facebook.com/janesmith',
                'linkedin_url' => 'https://linkedin.com/in/janesmith',
                'x_url' => 'https://x.com/janesmith',
            ],
            [
                'name' => 'Michael Brown',
                'position' => 'Lead Developer',
                'facebook_url' => 'https://facebook.com/michaelbrown',
                'linkedin_url' => 'https://linkedin.com/in/michaelbrown',
                'x_url' => 'https://x.com/michaelbrown',
            ],
        ];

        foreach ($staffData as $staff) {
            // Use loremflickr to get a random business/person image
            // Adding a random parameter to ensure different images
            $random = rand(1, 1000);
            $imageUrl = "https://loremflickr.com/500/500/business,person/all?random={$random}";

            // Download image to temp file
            $tempPath = sys_get_temp_dir() . '/' . \Illuminate\Support\Str::random(10) . '.jpg';

            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            $imageContent = file_get_contents($imageUrl, false, stream_context_create($arrContextOptions));

            if ($imageContent !== false) {
                file_put_contents($tempPath, $imageContent);

                $file = new \Illuminate\Http\UploadedFile(
                    $tempPath,
                    'staff.jpg',
                    'image/jpeg',
                    null,
                    true
                );

                $uploadPath = fileUploadStorage($file, 'staff_images', 500, 500);
            } else {
                $uploadPath = null;
            }

            Staff::create([
                'image' => $uploadPath,
                'name' => $staff['name'],
                'position' => $staff['position'],
                'facebook_url' => $staff['facebook_url'],
                'linkedin_url' => $staff['linkedin_url'],
                'x_url' => $staff['x_url'],
                'status' => 'active',
            ]);
        }
    }
}
