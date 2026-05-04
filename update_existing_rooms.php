<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\RoomType;
use App\Models\Room;

try {
    // Update the existing Standard room type to Luxury Room 1
    $standard = RoomType::where('typeName', 'Standard')->first();
    if ($standard) {
        $standard->update([
            'description' => 'Luxury Room 1 - Premium accommodation',
            'pricePerNight' => 1500.00,
        ]);
        echo "Updated Standard to Luxury Room 1\n";
        
        // Clear existing rooms
        Room::query()->delete();
        
        // Add rooms for this type
        Room::create(['roomTypeID' => $standard->roomTypeID, 'roomNum' => 'L1-101', 'status' => 'Available']);
        Room::create(['roomTypeID' => $standard->roomTypeID, 'roomNum' => 'L1-102', 'status' => 'Available']);
        Room::create(['roomTypeID' => $standard->roomTypeID, 'roomNum' => 'L1-103', 'status' => 'Available']);
        
        echo "Created 3 Luxury Room 1 rooms\n";
    }
    
    echo "\n✓ Rooms updated successfully!\n";
    echo "\nNote: Your database column 'typeName' is too small to hold longer names.\n";
    echo "Please run this SQL to fix it:\n";
    echo "ALTER TABLE RoomTypes MODIFY typeName VARCHAR(100);\n";
    echo "ALTER TABLE RoomTypes MODIFY description TEXT;\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
