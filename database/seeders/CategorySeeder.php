<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Produk elektronik seperti laptop, komputer, dan aksesoris',
            ],
            [
                'name' => 'Smartphone & Aksesoris',
                'description' => 'Smartphone, tablet, dan aksesorisnya',
            ],
            [
                'name' => 'Furniture',
                'description' => 'Perabotan rumah dan kantor',
            ],
            [
                'name' => 'Alat Tulis & Kantor',
                'description' => 'Perlengkapan tulis menulis dan keperluan kantor',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Pakaian, sepatu, dan aksesoris fashion',
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Produk makanan dan minuman',
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'description' => 'Produk kesehatan dan perawatan tubuh',
            ],
            [
                'name' => 'Olahraga & Outdoor',
                'description' => 'Peralatan olahraga dan kegiatan outdoor',
            ],
            [
                'name' => 'Buku & Media',
                'description' => 'Buku, majalah, dan media lainnya',
            ],
            [
                'name' => 'Mainan & Hobi',
                'description' => 'Mainan anak dan perlengkapan hobi',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
