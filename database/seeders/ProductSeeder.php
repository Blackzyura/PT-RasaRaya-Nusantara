<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sambal = Category::where('slug', 'sambal-nusantara')->first();
        $bumbu = Category::where('slug', 'bumbu-rempah')->first();
        $camilan = Category::where('slug', 'camilan-tradisional')->first();
        $minuman = Category::where('slug', 'minuman-herbal')->first();

        $products = [
            [
                'category_id' => $sambal->id,
                'name' => 'Sambal Roa Asli Manado',
                'slug' => 'sambal-roa-asli-manado',
                'price' => 38000,
                'stock' => 45,
                'unit' => 'botol 150g',
                'description' => 'Sambal Roa khas Sulawesi Utara yang dibuat dari ikan roa asap pilihan, cabai rawit segar, dan bawang merah goreng. Cocok disantap bersama nasi hangat, pisang goreng, maupun lauk pauk harian.',
                'image' => 'products/sambal-roa-manado.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $sambal->id,
                'name' => 'Sambal Bawang Crispy RasaRaya',
                'slug' => 'sambal-bawang-crispy-rasaraya',
                'price' => 29000,
                'stock' => 60,
                'unit' => 'botol 150g',
                'description' => 'Perpaduan cabai rawit merah dan bawang putih renyah yang dimasak perlahan dengan minyak kelapa murni. Pedasnya pas, gurih, dan tahan lama tanpa bahan pengawet.',
                'image' => 'products/sambal-bawang-crispy.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $bumbu->id,
                'name' => 'Bumbu Rendang Padang Tradisional',
                'slug' => 'bumbu-rendang-padang-tradisional',
                'price' => 32000,
                'stock' => 35,
                'unit' => 'pouch 200g',
                'description' => 'Bumbu rendang basah racikan rempah Minangkabau asli: lengkuas, serai, kunyit, kemiri, dan kelapa sangrai. Praktis untuk memasak 1 kg daging sapi atau ayam di rumah.',
                'image' => 'products/bumbu-rendang-padang.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $camilan->id,
                'name' => 'Keripik Tempe Sagu Daun Jeruk',
                'slug' => 'keripik-tempe-sagu-daun-jeruk',
                'price' => 24000,
                'stock' => 80,
                'unit' => 'pouch 180g',
                'description' => 'Keripik tempe tipis dan super renyah berbalut tepung sagu berbumbu ketumbar serta irisan daun jeruk wangi. Digoreng dengan minyak baru sehingga tidak berminyak.',
                'image' => 'products/keripik-tempe-sagu.jpg',
                'is_featured' => false,
            ],
            [
                'category_id' => $minuman->id,
                'name' => 'Wedang Uwuh Rempah Jogja',
                'slug' => 'wedang-uwuh-rempah-jogja',
                'price' => 35000,
                'stock' => 50,
                'unit' => 'box 10 sachet',
                'description' => 'Minuman herbal tradisional Yogyakarta berisi kayu secang, jahe emprit kering, cengkeh, kayu manis, daun pala, dan gula batu kristal. Membantu menghangatkan tubuh dan menjaga stamina.',
                'image' => 'products/wedang-uwuh-jogja.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $minuman->id,
                'name' => 'Bandrek Jahe Merah Gula Aren',
                'slug' => 'bandrek-jahe-merah-gula-aren',
                'price' => 30000,
                'stock' => 40,
                'unit' => 'box 8 sachet',
                'description' => 'Seduhan jahe merah pedas hangat yang dipadukan dengan gula aren organik, sereh, dan lada hitam. Nikmat disajikan hangat saat pagi atau malam hari.',
                'image' => 'products/bandrek-jahe-merah.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
