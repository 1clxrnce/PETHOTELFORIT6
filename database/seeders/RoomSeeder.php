<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        // Create Room Types
        $standardType = RoomType::create([
            'typeName' => 'Standard Room',
            'description' => 'Cozy and comfortable room perfect for small to medium pets. Includes basic amenities and daily cleaning.',
            'pricePerNight' => 500.00,
            'maxCapacity' => 1,
        ]);

        $deluxeType = RoomType::create([
            'typeName' => 'Deluxe Room',
            'description' => 'Spacious room with premium bedding and toys. Ideal for medium to large pets with extra comfort.',
            'pricePerNight' => 800.00,
            'maxCapacity' => 1,
        ]);

        $suiteType = RoomType::create([
            'typeName' => 'Suite',
            'description' => 'Luxury suite with play area, premium amenities, and personalized care. Perfect for pampered pets.',
            'pricePerNight' => 1200.00,
            'maxCapacity' => 2,
        ]);

        $familyType = RoomType::create([
            'typeName' => 'Family Suite',
            'description' => 'Extra large suite designed for multiple pets from the same family. Includes separate sleeping areas.',
            'pricePerNight' => 1500.00,
            'maxCapacity' => 3,
        ]);

        // Create Rooms
        $rooms = [
            // Standard Rooms (101-105)
            ['roomTypeID' => $standardType->roomTypeID, 'roomNum' => '101', 'status' => 'Available'],
            ['roomTypeID' => $standardType->roomTypeID, 'roomNum' => '102', 'status' => 'Available'],
            ['roomTypeID' => $standardType->roomTypeID, 'roomNum' => '103', 'status' => 'Available'],
            ['roomTypeID' => $standardType->roomTypeID, 'roomNum' => '104', 'status' => 'Available'],
            ['roomTypeID' => $standardType->roomTypeID, 'roomNum' => '105', 'status' => 'Available'],
            
            // Deluxe Rooms (201-204)
            ['roomTypeID' => $deluxeType->roomTypeID, 'roomNum' => '201', 'status' => 'Available'],
            ['roomTypeID' => $deluxeType->roomTypeID, 'roomNum' => '202', 'status' => 'Available'],
            ['roomTypeID' => $deluxeType->roomTypeID, 'roomNum' => '203', 'status' => 'Available'],
            ['roomTypeID' => $deluxeType->roomTypeID, 'roomNum' => '204', 'status' => 'Available'],
            
            // Suites (301-303)
            ['roomTypeID' => $suiteType->roomTypeID, 'roomNum' => '301', 'status' => 'Available'],
            ['roomTypeID' => $suiteType->roomTypeID, 'roomNum' => '302', 'status' => 'Available'],
            ['roomTypeID' => $suiteType->roomTypeID, 'roomNum' => '303', 'status' => 'Available'],
            
            // Family Suites (401-402)
            ['roomTypeID' => $familyType->roomTypeID, 'roomNum' => '401', 'status' => 'Available'],
            ['roomTypeID' => $familyType->roomTypeID, 'roomNum' => '402', 'status' => 'Available'],
        ];

        foreach ($rooms as $roomData) {
            Room::create($roomData);
        }

        $this->command->info('Room types and rooms seeded successfully!');
    }
}

