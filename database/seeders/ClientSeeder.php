<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            'Lexur YY',
            'Snowee',
            'Qunda',
            'Mechanic',
            'Zoyi',
            'Huayu',
            'Value',
            'Megmeet',
            'Topband',
            'Atomberg',
            'Relaince',
            'Eastman',
            'mitsubushi Electric',
            'Daikin',
            'LG',
            'Samsung',
            'Ogenral',
            'Aspen',
            'Btali',
        ];

        foreach ($clients as $clientName) {
            // Generate a random color avatar for the logo
            $imageUrl = "https://ui-avatars.com/api/?name=" . urlencode($clientName) . "&background=random&size=300&color=fff";

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
                    'client.png',
                    'image/png',
                    null,
                    true
                );

                // Use specific size for logos (155x30)
                $uploadPath = fileUploadStorage($file, 'client_images', 155, 30);
            }

            Client::create([
                'image' => $uploadPath,
                'name' => $clientName,
                'status' => 'active',
            ]);
        }
    }
}
