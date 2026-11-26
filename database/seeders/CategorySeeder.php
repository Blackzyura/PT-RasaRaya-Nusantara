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
                'name' => 'Sambal Nusantara',
                'slug' => 'sambal-nusantara',
                'description' => 'Aneka sambal autentik dari berbagai daerah di Indonesia dengan cabai segar pilihan.',
            ],
            [
                'name' => 'Bumbu Rempah',
                'slug' => 'bumbu-rempah',
                'description' => 'Bumbu masak siap saji berbahan rempah asli Nusantara tanpa pengawet buatan.',
            ],
            [
                'name' => 'Camilan Tradisional',
                'slug' => 'camilan-tradisional',
                'description' => 'Kudapan renyah dan gurih khas UMKM lokal yang diolah secara higienis.',
            ],
            [
                'name' => 'Minuman Herbal',
                'slug' => 'minuman-herbal',
                'description' => 'Minuman tradisional penghangat badan dari racikan jahe, kayu manis, dan rempah.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
