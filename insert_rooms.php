<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Get existing room types
    $roomTypes = DB::table('RoomTypes')->get();
    
    if ($roomTypes->isEmpty()) {
        echo "No room types found. Creating them first...\n";
        
        $standardId = DB::table('RoomTypes')->insertGetId([
            'typeName' => 'Standard',
            'description' => 'Cozy room',
            'pricePerNight' => 500.00,
            'maxCapacity' => 1,
        ]);

        $deluxeId = DB::table('RoomTypes')->insertGetId([
            'typeName' => 'Deluxe',
            'description' => 'Spacious room',
            'pricePerNight' => 800.00,
            'maxCapacity' => 1,
        ]);

        $suiteId = DB::table('RoomTypes')->insertGetId([
            'typeName' => 'Suite',
            'description' => 'Luxury suite',
            'pricePerNight' => 1200.00,
            'maxCapacity' => 2,
        ]);
        
        echo "Room types created!\n";
    } else {
        echo "Found existing room types:\n";
        foreach ($roomTypes as $rt) {
            echo "  - {$rt->typeName} (ID: {$rt->roomTypeID})\n";
        }
        
        $standardId = $roomTypes->where('typeName', 'Standard')->first()->roomTypeID ?? null;
        $deluxeId = $roomTypes->where('typeName', 'Deluxe')->first()->roomTypeID ?? null;
        $suiteId = $roomTypes->where('typeName', 'Suite')->first()->roomTypeID ?? null;
    }

    // Insert Rooms
    $rooms = [];
    if ($standardId) {
        $rooms[] = ['roomTypeID' => $standardId, 'roomNum' => '101', 'status' => 'Available'];
        $rooms[] = ['roomTypeID' => $standardId, 'roomNum' => '102', 'status' => 'Available'];
        $rooms[] = ['roomTypeID' => $standardId, 'roomNum' => '103', 'status' => 'Available'];
    }
    if ($deluxeId) {
        $rooms[] = ['roomTypeID' => $deluxeId, 'roomNum' => '201', 'status' => 'Available'];
        $rooms[] = ['roomTypeID' => $deluxeId, 'roomNum' => '202', 'status' => 'Available'];
    }
    if ($suiteId) {
        $rooms[] = ['roomTypeID' => $suiteId, 'roomNum' => '301', 'status' => 'Available'];
    }

    if (!empty($rooms)) {
        DB::table('Rooms')->insert($rooms);
        echo "Rooms created: " . count($rooms) . "\n";
    }

    // Insert Add-ons
    $existingAddOns = DB::table('AddOns')->count();
    if ($existingAddOns == 0) {
        DB::table('AddOns')->insert([
            ['addOnName' => 'Extra Playtime', 'price' => 150.00],
            ['addOnName' => 'Grooming', 'price' => 300.00],
            ['addOnName' => 'Premium Food', 'price' => 200.00],
        ]);
        echo "Add-ons created!\n";
    } else {
        echo "Add-ons already exist.\n";
    }

    echo "\nAll data inserted successfully!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
