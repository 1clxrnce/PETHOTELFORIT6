-- Insert Room Types
INSERT INTO RoomTypes (typeName, description, pricePerNight, maxCapacity) VALUES
('Standard Room', 'Cozy and comfortable room perfect for small to medium pets. Includes basic amenities and daily cleaning.', 500.00, 1),
('Deluxe Room', 'Spacious room with premium bedding and toys. Ideal for medium to large pets with extra comfort.', 800.00, 1),
('Suite', 'Luxury suite with play area, premium amenities, and personalized care. Perfect for pampered pets.', 1200.00, 2),
('Family Suite', 'Extra large suite designed for multiple pets from the same family. Includes separate sleeping areas.', 1500.00, 3);

-- Insert Rooms (Standard Rooms)
INSERT INTO Rooms (roomTypeID, roomNum, roomPhoto, status) 
SELECT roomTypeID, '101', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Standard Room'
UNION ALL
SELECT roomTypeID, '102', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Standard Room'
UNION ALL
SELECT roomTypeID, '103', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Standard Room'
UNION ALL
SELECT roomTypeID, '104', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Standard Room'
UNION ALL
SELECT roomTypeID, '105', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Standard Room';

-- Insert Rooms (Deluxe Rooms)
INSERT INTO Rooms (roomTypeID, roomNum, roomPhoto, status) 
SELECT roomTypeID, '201', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Deluxe Room'
UNION ALL
SELECT roomTypeID, '202', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Deluxe Room'
UNION ALL
SELECT roomTypeID, '203', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Deluxe Room'
UNION ALL
SELECT roomTypeID, '204', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Deluxe Room';

-- Insert Rooms (Suites)
INSERT INTO Rooms (roomTypeID, roomNum, roomPhoto, status) 
SELECT roomTypeID, '301', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Suite'
UNION ALL
SELECT roomTypeID, '302', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Suite'
UNION ALL
SELECT roomTypeID, '303', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Suite';

-- Insert Rooms (Family Suites)
INSERT INTO Rooms (roomTypeID, roomNum, roomPhoto, status) 
SELECT roomTypeID, '401', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Family Suite'
UNION ALL
SELECT roomTypeID, '402', NULL, 'Available' FROM RoomTypes WHERE typeName = 'Family Suite';

-- Insert Add-ons
INSERT INTO AddOns (addOnName, price) VALUES
('Extra Playtime', 150.00),
('Grooming Service', 300.00),
('Premium Food', 200.00),
('Spa Treatment', 500.00),
('Training Session', 400.00),
('Photo Session', 250.00);
