<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddOnSeeder extends Seeder
{
    public function run()
    {
        $addOns = [
            [
                'addOnName' => 'Extra Playtime',
                'price' => 150.00,
            ],
            [
                'addOnName' => 'Grooming Service',
                'price' => 300.00,
            ],
            [
                'addOnName' => 'Premium Food',
                'price' => 200.00,
            ],
            [
                'addOnName' => 'Spa Treatment',
                'price' => 500.00,
            ],
            [
                'addOnName' => 'Training Session',
                'price' => 400.00,
            ],
            [
                'addOnName' => 'Photo Session',
                'price' => 250.00,
            ],
        ];

        foreach ($addOns as $addOn) {
            DB::table('AddOns')->insert($addOn);
        }

        $this->command->info('Add-ons seeded successfully!');
    }
}
