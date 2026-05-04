<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimpleRoomSeeder extends Seeder
{
    public function run()
    {
        // Insert Room Types with shorter names first
        DB::statement("INSERT INTO RoomTypes (typeName, description, pricePerNight, maxCapacity) VALUES ('Standard', 'Cozy room for small to medium pets', 500.00, 1)");
        DB::statement("INSERT INTO RoomTypes (typeName, description, pricePerNight, maxCapacity) VALUES ('Deluxe', 'Spacious room with premium amenities', 800.00, 1)");
        DB::statement("INSERT INTO RoomTypes (typeName, description, pricePerNight, maxCapacity) VALUES ('Suite', 'Luxury suite with play area', 1200.00, 2)");
        DB::statement("INSERT INTO RoomTypes (typeName, description, pricePerNight, maxCapacity) VALUES ('Family', 'Extra large suite for multiple pets', 1500.00, 3)");

        // Get IDs
        $standard = DB::table('RoomTypes')->where('typeName', 'Standard')->first()->roomTypeID;
        $deluxe = DB::table('RoomTypes')->where('typeName', 'Deluxe')->first()->roomTypeID;
        $suite = DB::table('RoomTypes')->where('typeName', 'Suite')->first()->roomTypeID;
        $family = DB::table('RoomTypes')->where('typeName', 'Family')->first()->roomTypeID;

        // Insert Rooms
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($standard, '101', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($standard, '102', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($standard, '103', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($deluxe, '201', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($deluxe, '202', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($suite, '301', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($suite, '302', 'Available')");
        DB::statement("INSERT INTO Rooms (roomTypeID, roomNum, status) VALUES ($family, '401', 'Available')");

        // Insert Add-ons
        DB::statement("INSERT INTO AddOns (addOnName, price) VALUES ('Extra Playtime', 150.00)");
        DB::statement("INSERT INTO AddOns (addOnName, price) VALUES ('Grooming', 300.00)");
        DB::statement("INSERT INTO AddOns (addOnName, price) VALUES ('Premium Food', 200.00)");
        DB::statement("INSERT INTO AddOns (addOnName, price) VALUES ('Spa Treatment', 500.00)");

        $this->command->info('Rooms and add-ons seeded successfully!');
    }
}
