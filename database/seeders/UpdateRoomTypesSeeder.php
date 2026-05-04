<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateRoomTypesSeeder extends Seeder
{
    public function run()
    {
        // Update existing room types to have higher capacity
        DB::table('RoomTypes')->where('roomTypeID', 3)->update(['maxCapacity' => 2]);
        DB::table('RoomTypes')->where('roomTypeID', 4)->update(['maxCapacity' => 3]);
        DB::table('RoomTypes')->where('roomTypeID', 5)->update(['maxCapacity' => 4]);

        // Add new room types with various capacities
        $newRoomTypes = [
            [
                'typeName' => 'Standard Room',
                'description' => 'Comfortable room for 1-2 pets with basic amenities',
                'pricePerNight' => 500.00,
                'maxCapacity' => 2,
            ],
            [
                'typeName' => 'Deluxe Room',
                'description' => 'Spacious room for 2-3 pets with premium amenities',
                'pricePerNight' => 1000.00,
                'maxCapacity' => 3,
            ],
            [
                'typeName' => 'Family Suite',
                'description' => 'Large suite perfect for 4-5 pets with play area',
                'pricePerNight' => 2000.00,
                'maxCapacity' => 5,
            ],
            [
                'typeName' => 'VIP Suite',
                'description' => 'Premium suite for up to 6 pets with luxury amenities',
                'pricePerNight' => 3000.00,
                'maxCapacity' => 6,
            ],
        ];

        foreach ($newRoomTypes as $roomType) {
            // Check if room type already exists
            $exists = DB::table('RoomTypes')->where('typeName', $roomType['typeName'])->exists();
            if (!$exists) {
                DB::table('RoomTypes')->insert($roomType);
            }
        }

        $this->command->info('Room types updated successfully with higher capacities!');
    }
}
