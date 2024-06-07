<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 2,
        ]);

        \App\Models\User::factory()->create([
            'id' => 2,
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => 1,
            'password' => bcrypt('admin'),
        ]);

       
        // $this->call(AdminsTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(CmsPageTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
    }
}
