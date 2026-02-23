<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\category;
use App\Models\tool;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create();   
        User::factory()->officer()->create(); 
        User::factory(5)->create();           

        category::insert([
            ['nama_kategori' => 'alat tulis', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'alat olahraga', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'alat pembersih', 'created_at' => now(), 'updated_at' => now()],
        ]);

        tool::insert([
            ['name_tools' => 'pena', 'category_id' => 1, 'stock' => 10, 'created_at' => now(), 'price' => 1000],
            ['name_tools' => 'bola basket', 'category_id' => 2, 'stock' => 10, 'created_at' => now(),'price' => 2000],
            ['name_tools' => 'lap', 'category_id' => 3, 'stock' => 10, 'created_at' => now(),'price' => 3000],
        ]);
    }
}
