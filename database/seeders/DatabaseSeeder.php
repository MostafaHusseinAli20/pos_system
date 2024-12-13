<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionAndUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CateigorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ClientSeeder::class);
    }
}
