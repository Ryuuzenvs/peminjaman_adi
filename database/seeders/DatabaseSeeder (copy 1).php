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
        // Tetap buat User untuk login
        User::factory()->admin()->create();   
        User::factory()->officer()->create(); 
        User::factory(5)->create();           

        // Kategori Rental PS
        category::insert([
            ['nama_kategori' => 'Konsol PS', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Controller', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Alat/Barang Rental PS
        tool::insert([
            // Unit PS
            ['name_tools' => 'PlayStation 5 Digital Edition', 'category_id' => 1, 'stock' => 5, 'created_at' => now()],
            ['name_tools' => 'PlayStation 4 Pro', 'category_id' => 1, 'stock' => 8, 'created_at' => now()],
            
            // Stik / Controller
            ['name_tools' => 'DualSense Edge (PS5)', 'category_id' => 2, 'stock' => 10, 'created_at' => now()],
            ['name_tools' => 'DualShock 4 (PS4)', 'category_id' => 2, 'stock' => 15, 'created_at' => now()],
            
            // Aksesoris Lain
            ['name_tools' => 'PSVR 2 Set', 'category_id' => 3, 'stock' => 2, 'created_at' => now()],
            ['name_tools' => 'Headset Pulse 3D', 'category_id' => 3, 'stock' => 5, 'created_at' => now()],
        ]);
    }
}
