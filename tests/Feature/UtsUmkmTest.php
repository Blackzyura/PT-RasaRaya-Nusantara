<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UtsUmkmTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin RasaRaya',
            'email' => 'admin@rasarayanusantara.co.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }

    public function test_public_homepage_displays_company_profile_and_seeded_products(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('PT RasaRaya Nusantara');
        $response->assertSee('Mengenal PT RasaRaya Nusantara');
        $response->assertSee('Sambal Roa Asli Manado');
        $response->assertSee('Masuk');
        $response->assertSee('Daftar');
        $this->assertGreaterThanOrEqual(5, Product::count());
    }

    public function test_public_product_detail_page_renders(): void
    {
        $this->seed(DatabaseSeeder::class);
        $product = Product::firstOrFail();

        $response = $this->get(route('products.show', $product->slug));

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->category->name);
        $response->assertSee('Masuk untuk Memesan via WhatsApp');
        $response->assertDontSee('wa.me/6281234567890');

        $customer = User::where('role', 'customer')->firstOrFail();
        $this->actingAs($customer)
            ->get(route('products.show', $product->slug))
            ->assertStatus(200)
            ->assertSee('Pesan via WhatsApp')
            ->assertSee('wa.me/6281234567890');

        $admin = User::where('role', 'admin')->firstOrFail();
        $this->actingAs($admin)
            ->get(route('products.show', $product->slug))
            ->assertStatus(200)
            ->assertDontSee('Pesan via WhatsApp')
            ->assertDontSee('wa.me/6281234567890');
    }

    public function test_admin_routes_require_login_and_login_logout_flow_works(): void
    {
        $this->createAdmin();

        $this->get(route('admin.products.index'))->assertRedirect(route('login'));

        $this->post(route('login.attempt'), [
            'email' => 'admin@rasarayanusantara.co.id',
            'password' => 'salah',
        ])->assertSessionHasErrors('email');

        $this->post(route('login.attempt'), [
            'email' => 'admin@rasarayanusantara.co.id',
            'password' => 'password',
        ])->assertRedirect(route('admin.products.index'));

        $this->get(route('admin.products.index'))->assertStatus(200);
        $this->get('/')->assertSee('Admin Panel');

        $this->post(route('logout'))->assertRedirect(route('home'));
        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
    }

    public function test_public_register_saves_to_database_blocks_admin_and_syncs_to_admin_users(): void
    {
        $admin = $this->createAdmin();

        $registerResponse = $this->post(route('register.store'), [
            'name' => 'Siti Aminah',
            'email' => 'siti@contoh.id',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ]);

        $registerResponse->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'email' => 'siti@contoh.id',
            'role' => 'customer',
        ]);

        // Customer tidak bisa masuk ke halaman admin
        $this->get(route('admin.products.index'))->assertRedirect(route('home'));

        // Admin melihat pengguna baru di halaman /admin/users
        $this->actingAs($admin)
            ->get(route('admin.users.index'))
            ->assertStatus(200)
            ->assertSee('Siti Aminah')
            ->assertSee('siti@contoh.id');
    }

    public function test_admin_product_store_validates_uploads_image_and_syncs_to_public(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();
        $category = Category::create([
            'name' => 'Sambal Nusantara',
            'slug' => 'sambal-nusantara',
        ]);

        // Test server-side validation fails on empty / invalid input
        $invalidResponse = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => '',
            'name' => str_repeat('A', 130),
            'price' => 'bukan-angka',
        ]);
        $invalidResponse->assertSessionHasErrors(['category_id', 'name', 'price', 'stock', 'unit', 'description', 'image']);

        // Test valid product creation with image upload (self-contained 1x1 JPEG so GD/external files are not required)
        $tempImage = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test-sambal.jpg';
        file_put_contents($tempImage, base64_decode(
            '/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////wgALCAABAAEBAREA/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPxA='
        ));
        $file = new UploadedFile($tempImage, 'sambal-baru.jpg', 'image/jpeg', null, true);

        $validResponse = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Sambal Cakalang Asap',
            'price' => 42000,
            'stock' => 25,
            'unit' => 'botol 150g',
            'description' => 'Sambal cakalang asap khas Manado.',
            'image' => $file,
            'is_featured' => '1',
        ]);

        $validResponse->assertRedirect(route('admin.products.index'));
        $product = Product::where('name', 'Sambal Cakalang Asap')->firstOrFail();
        Storage::disk('public')->assertExists($product->image);

        // Verify synced immediately on public pages
        $this->get('/')->assertSee('Sambal Cakalang Asap');
        $this->get(route('products.show', $product->slug))->assertStatus(200)->assertSee('Sambal Cakalang Asap');
    }

    public function test_admin_product_update_and_delete_syncs_with_public(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();
        $category = Category::create([
            'name' => 'Bumbu Rempah',
            'slug' => 'bumbu-rempah',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Bumbu Soto',
            'slug' => 'bumbu-soto',
            'price' => 20000,
            'stock' => 15,
            'unit' => 'pouch 100g',
            'description' => 'Bumbu soto ayam Lamongan.',
            'is_featured' => false,
        ]);

        $updateResponse = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Bumbu Soto Lamongan Spesial',
            'price' => 25000,
            'stock' => 30,
            'unit' => 'pouch 150g',
            'description' => 'Bumbu soto ayam Lamongan dengan koya gurih.',
        ]);

        $updateResponse->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Bumbu Soto Lamongan Spesial', 'price' => 25000]);
        $this->get('/')->assertSee('Bumbu Soto Lamongan Spesial');

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.products.destroy', $product));
        $deleteResponse->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->get('/')->assertDontSee('Bumbu Soto Lamongan Spesial');
    }
}
