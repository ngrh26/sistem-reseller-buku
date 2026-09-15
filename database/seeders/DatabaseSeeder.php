<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Paket Reseller
        |--------------------------------------------------------------------------
        */

        Package::updateOrCreate(
            ['name' => 'Starter'],
            [
                'discount_percentage' => 15,
                'min_purchase' => 5,
            ]
        );

        Package::updateOrCreate(
            ['name' => 'Profesional'],
            [
                'discount_percentage' => 20,
                'min_purchase' => 20,
            ]
        );

        Package::updateOrCreate(
            ['name' => 'Distributor'],
            [
                'discount_percentage' => 30,
                'min_purchase' => 40,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Akun Admin
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'admin@cybermedia.com',
            ],
            [
                'name' => 'Administrator',
                'password' => 'admin123',
                'role' => 'admin',
                'status' => 'active',
                'phone' => '080000000000',
                'address' => 'PT Cyber Media Teknologi',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Produk Buku
        |--------------------------------------------------------------------------
        */

        $products = [
            [
                'title' => 'Pemrograman Web dengan Laravel',
                'author' => 'Andi Pratama',
                'price' => 85000,
                'stock' => 50,
                'description' => 'Buku panduan mempelajari pengembangan aplikasi web menggunakan framework Laravel.',
                'cover_image' => null,
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Dasar-Dasar Pemrograman',
                'author' => 'Budi Santoso',
                'price' => 75000,
                'stock' => 60,
                'description' => 'Panduan dasar untuk memahami konsep pemrograman bagi pemula.',
                'cover_image' => null,
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Belajar Database MySQL',
                'author' => 'Dimas Saputra',
                'price' => 80000,
                'stock' => 45,
                'description' => 'Buku pembelajaran database MySQL mulai dari konsep dasar hingga pengelolaan database.',
                'cover_image' => null,
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Algoritma dan Struktur Data',
                'author' => 'Rizky Ramadhan',
                'price' => 90000,
                'stock' => 40,
                'description' => 'Membahas algoritma dan struktur data untuk mendukung kemampuan pemrograman.',
                'cover_image' => null,
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Pengantar Teknologi Informasi',
                'author' => 'Siti Rahma',
                'price' => 70000,
                'stock' => 55,
                'description' => 'Pengenalan berbagai konsep dan perkembangan teknologi informasi.',
                'cover_image' => null,
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Manajemen Bisnis Digital',
                'author' => 'Fajar Nugroho',
                'price' => 95000,
                'stock' => 35,
                'description' => 'Membahas konsep manajemen dan strategi bisnis di era digital.',
                'cover_image' => null,
                'category' => 'Bisnis',
            ],
            [
                'title' => 'Strategi Pemasaran Modern',
                'author' => 'Agus Setiawan',
                'price' => 88000,
                'stock' => 30,
                'description' => 'Panduan memahami strategi pemasaran modern dan pemanfaatan teknologi digital.',
                'cover_image' => null,
                'category' => 'Bisnis',
            ],
            [
                'title' => 'Kewirausahaan untuk Pemula',
                'author' => 'Nadia Permata',
                'price' => 72000,
                'stock' => 50,
                'description' => 'Buku pengantar kewirausahaan untuk pembaca yang ingin memulai bisnis.',
                'cover_image' => null,
                'category' => 'Bisnis',
            ],
            [
                'title' => 'Desain UI/UX untuk Aplikasi',
                'author' => 'Yoga Pratama',
                'price' => 92000,
                'stock' => 25,
                'description' => 'Mengenal prinsip desain antarmuka dan pengalaman pengguna untuk aplikasi digital.',
                'cover_image' => null,
                'category' => 'Desain',
            ],
            [
                'title' => 'Keamanan Sistem Informasi',
                'author' => 'Rian Kurniawan',
                'price' => 98000,
                'stock' => 30,
                'description' => 'Membahas konsep dasar keamanan sistem informasi dan perlindungan data.',
                'cover_image' => null,
                'category' => 'Keamanan',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                [
                    'title' => $product['title'],
                ],
                $product
            );
        }
    }
}