<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\RoomType;
use App\Models\Room;
use App\Models\AddOn;

try {
    // Clear existing data
    Room::query()->delete();
    RoomType::query()->delete();
    
    echo "Cleared existing room data.\n\n";

    // Insert Room Types based on the image
    $luxuryRoom1 = RoomType::create([
        'typeName' => 'Lux1',
        'description' => 'Premium',
        'pricePerNight' => 1500.00,
        'maxCapacity' => 1,
    ]);

    $luxuryRoom2 = RoomType::create([
        'typeName' => 'Lux2',
        'description' => 'Deluxe',
        'pricePerNight' => 1800.00,
        'maxCapacity' => 1,
    ]);

    $catRoom = RoomType::create([
        'typeName' => 'Cat',
        'description' => 'Cats',
        'pricePerNight' => 800.00,
        'maxCapacity' => 2,
    ]);

    echo "Room types created:\n";
    echo "  - Lux1 (ID: {$luxuryRoom1->roomTypeID}) - ₱1,500/night\n";
    echo "  - Lux2 (ID: {$luxuryRoom2->roomTypeID}) - ₱1,800/night\n";
    echo "  - Cat (ID: {$catRoom->roomTypeID}) - ₱800/night\n\n";

    // Insert Rooms
    $rooms = [
        // Luxury Room 1 rooms
        ['roomTypeID' => $luxuryRoom1->roomTypeID, 'roomNum' => 'LUX1-101', 'status' => 'Available'],
        ['roomTypeID' => $luxuryRoom1->roomTypeID, 'roomNum' => 'LUX1-102', 'status' => 'Available'],
        ['roomTypeID' => $luxuryRoom1->roomTypeID, 'roomNum' => 'LUX1-103', 'status' => 'Available'],
        
        // Luxury Room 2 rooms
        ['roomTypeID' => $luxuryRoom2->roomTypeID, 'roomNum' => 'LUX2-201', 'status' => 'Available'],
        ['roomTypeID' => $luxuryRoom2->roomTypeID, 'roomNum' => 'LUX2-202', 'status' => 'Available'],
        ['roomTypeID' => $luxuryRoom2->roomTypeID, 'roomNum' => 'LUX2-203', 'status' => 'Available'],
        
        // Cat Room rooms
        ['roomTypeID' => $catRoom->roomTypeID, 'roomNum' => 'CAT-301', 'status' => 'Available'],
        ['roomTypeID' => $catRoom->roomTypeID, 'roomNum' => 'CAT-302', 'status' => 'Available'],
        ['roomTypeID' => $catRoom->roomTypeID, 'roomNum' => 'CAT-303', 'status' => 'Available'],
        ['roomTypeID' => $catRoom->roomTypeID, 'roomNum' => 'CAT-304', 'status' => 'Available'],
    ];

    foreach ($rooms as $roomData) {
        Room::create($roomData);
    }
    
    echo "Rooms created: " . count($rooms) . " rooms\n\n";

    // Update or create Add-ons
    AddOn::query()->delete();
    $addOns = [
        ['addOnName' => 'Extra Playtime', 'price' => 150.00],
        ['addOnName' => 'Grooming Service', 'price' => 300.00],
        ['addOnName' => 'Premium Food', 'price' => 200.00],
        ['addOnName' => 'Spa Treatment', 'price' => 500.00],
        ['addOnName' => 'Training Session', 'price' => 400.00],
        ['addOnName' => 'Photo Session', 'price' => 250.00],
    ];
    
    foreach ($addOns as $addOnData) {
        AddOn::create($addOnData);
    }
    
    echo "Add-ons created: " . count($addOns) . " add-ons\n\n";

    echo "✓ All data updated successfully!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
