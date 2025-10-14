<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar nama produk yang realistis
        $products = [
            // Elektronik
            'Laptop ASUS ROG Strix G15',
            'Laptop Lenovo ThinkPad X1 Carbon',
            'Laptop HP Pavilion 14',
            'Mouse Logitech MX Master 3',
            'Keyboard Mechanical Keychron K2',
            'Monitor LG UltraWide 34"',
            'Webcam Logitech C920',
            'Headset Sony WH-1000XM5',
            'Speaker JBL Flip 6',
            'Printer Epson EcoTank L3250',

            // Smartphone & Aksesoris
            'Samsung Galaxy S24 Ultra',
            'iPhone 15 Pro Max',
            'Xiaomi Redmi Note 13 Pro',
            'Power Bank Anker 20000mAh',
            'Charger Fast Charging 65W',
            'Case iPhone Spigen Ultra Hybrid',
            'Tempered Glass Samsung',
            'TWS Earbuds Samsung Galaxy Buds',

            // Furniture
            'Meja Kerja Kayu Jati 120cm',
            'Kursi Gaming DXRacer Formula',
            'Kursi Kantor Ergonomis Herman Miller',
            'Rak Buku Minimalis 5 Tingkat',
            'Lemari Pakaian 3 Pintu',
            'Sofa L-Shape Fabric Modern',
            'Meja Belajar Anak Karakter',

            // Alat Tulis & Kantor
            'Pulpen Pilot G2 0.7mm (Pack 12)',
            'Pensil 2B Faber Castell (Pack 12)',
            'Buku Tulis Campus A5 80 Lembar',
            'Stapler Kenko HD-10',
            'Paper Clip Jumbo 100pcs',
            'Amplop Cokelat Folio',
            'Map Plastik Transparan A4',
            'Lem Stick UHU 40g',

            // Fashion
            'Kemeja Formal Pria Putih Slim Fit',
            'Kaos Polos Cotton Combed 30s',
            'Celana Jeans Pria Regular Fit',
            'Sepatu Sneakers Nike Air Max',
            'Tas Ransel Laptop Kalibre',
            'Dompet Kulit Pria Braun Buffel',
            'Jam Tangan Casio G-Shock',

            // Makanan & Minuman
            'Kopi Arabica Gayo 250gr',
            'Teh Hijau Organik Premium',
            'Mie Instan Indomie Goreng (Pack 40)',
            'Snack Keripik Kentang Lay\'s',
            'Cokelat Silverqueen 65gr',
            'Air Mineral Aqua 600ml (Pack 24)',

            // Kesehatan & Kecantikan
            'Masker Medis 3 Ply (Box 50)',
            'Hand Sanitizer 500ml',
            'Sabun Cuci Tangan Dettol 250ml',
            'Shampoo Pantene 340ml',
            'Pasta Gigi Pepsodent 190gr',
            'Vitamin C 1000mg (60 Tablet)',
        ];

        // Ambil nama produk secara sequential (tidak random)
        static $index = 0;
        $productName = $products[$index % count($products)];
        $index++;

        // Generate SKU berdasarkan nama produk
        $sku = 'PRD-' . strtoupper(substr(md5($productName), 0, 8));

        return [
            'name' => $productName,
            'sku' => $sku,
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'supplier_id' => Supplier::inRandomOrder()->first()?->id ?? Supplier::factory(),
            'price' => $this->faker->randomFloat(2, 10000, 5000000), // Rp 10.000 - Rp 5.000.000
            'stock' => $this->faker->numberBetween(0, 500),
            'description' => $this->faker->paragraph(2),
            'image' => null, // atau bisa generate dummy image URL
            'attributes' => null, // akan diisi via ProductAttribute
        ];
    }
}
