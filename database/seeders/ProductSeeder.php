<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['image' => '1.webp', 'name' => 'Product 1'],
            ['image' => '2.webp', 'name' => 'Product 2'],
            ['image' => '3.webp', 'name' => 'Product 3'],
            ['image' => '4.webp', 'name' => 'Product 4'],
            ['image' => '5.webp', 'name' => 'Product 5'],
            ['image' => '6-converted-from-png.webp', 'name' => 'Product 6'],
            ['image' => '7-converted-from-jpg.webp', 'name' => 'Product 7'],
            ['image' => '8-converted-from-png.webp', 'name' => 'Product 8'],
            ['image' => '9-converted-from-jpg.webp', 'name' => 'Product 9'],
        ];

        // Ensure the storage directory exists
        if (!Storage::disk('public')->exists('product_images')) {
            Storage::disk('public')->makeDirectory('product_images');
        }

        foreach ($products as $product) {
            $sourcePath = public_path('assets/front/agency/img/products/' . $product['image']);
            $destinationPath = 'product_images/' . $product['image'];

            // Allow re-seeding without error if file exists, or overwrite
            if (File::exists($sourcePath)) {
                // Copy file to storage
                Storage::disk('public')->put($destinationPath, File::get($sourcePath));

                Product::create([
                    'name' => 'Quality AC Spare Parts', // Using the caption from the design
                    'image' => $destinationPath,
                    'status' => 'active',
                ]);
            }
        }
    }
}
