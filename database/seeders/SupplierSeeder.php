<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Elektronik Jaya Sentosa',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-5551234',
                'email' => 'elektronik@jayasentosa.com',
                'address' => 'Jl. Industri No. 45, Jakarta Utara',
            ],
            [
                'name' => 'CV. Mitra Teknologi Indonesia',
                'contact_person' => 'Siti Nurhaliza',
                'phone' => '022-8765432',
                'email' => 'info@mitrateknologi.co.id',
                'address' => 'Jl. Soekarno Hatta No. 123, Bandung',
            ],
            [
                'name' => 'PT. Furniture Prima Mandiri',
                'contact_person' => 'Ahmad Hidayat',
                'phone' => '031-7778888',
                'email' => 'sales@furnitureprimamadiiri.com',
                'address' => 'Jl. Raya Darmo No. 78, Surabaya',
            ],
            [
                'name' => 'UD. Supplier Alat Tulis Sejahtera',
                'contact_person' => 'Dewi Lestari',
                'phone' => '024-6669999',
                'email' => 'order@alattulis-sejahtera.com',
                'address' => 'Jl. Pemuda No. 56, Semarang',
            ],
            [
                'name' => 'CV. Fashion Global Indonesia',
                'contact_person' => 'Rendra Pratama',
                'phone' => '0274-555123',
                'email' => 'cs@fashionglobal.co.id',
                'address' => 'Jl. Malioboro No. 234, Yogyakarta',
            ],
            [
                'name' => 'PT. Distributor Makanan Nusantara',
                'contact_person' => 'Nur Azizah',
                'phone' => '061-4445555',
                'email' => 'distribusi@makanannusantara.com',
                'address' => 'Jl. Gatot Subroto No. 89, Medan',
            ],
            [
                'name' => 'CV. Kesehatan & Kecantikan Bersama',
                'contact_person' => 'Andi Wijaya',
                'phone' => '0361-888777',
                'email' => 'info@kesehatankecantikan.co.id',
                'address' => 'Jl. Sunset Road No. 12, Denpasar',
            ],
            [
                'name' => 'PT. Olahraga Indonesia Jaya',
                'contact_person' => 'Farhan Maulana',
                'phone' => '021-9998877',
                'email' => 'sales@olahragaindonesia.com',
                'address' => 'Jl. Sudirman No. 101, Jakarta Selatan',
            ],
            [
                'name' => 'Toko Buku & Media Nusantara',
                'contact_person' => 'Lisa Permata',
                'phone' => '0251-333222',
                'email' => 'order@bukunusantara.com',
                'address' => 'Jl. Pajajaran No. 67, Bogor',
            ],
            [
                'name' => 'CV. Mainan Ceria Indonesia',
                'contact_person' => 'Doni Setiawan',
                'phone' => '0411-666555',
                'email' => 'cs@mainanceria.co.id',
                'address' => 'Jl. Veteran No. 45, Makassar',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
