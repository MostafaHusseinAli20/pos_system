<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = 
        [
            'ahmed',
        ];

        foreach ($clients as $client) {

            Client::create([
               'name' => $client,
               'phone' => ['011111112'],
               'address' => 'haram',
            ]);
        }
    }
}
