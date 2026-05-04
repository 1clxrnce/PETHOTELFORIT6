-- Create Admin Account
-- Username: admin
-- Password: admin123 (change this after first login!)

-- Insert Admin User
INSERT INTO Users (username, password, role, status) 
VALUES ('admin', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5GyYXq0wJgPSS', 'Admin', 'Active');

-- Get the userID (replace @userID with the actual userID from the insert above)
SET @userID = LAST_INSERT_ID();

-- Insert Admin Employee Profile
INSERT INTO Employees (userID, empFName, empMName, empLName, phoneNum, email, birthdate, gender, address)
VALUES (@userID, 'System', NULL, 'Administrator', '09000000000', 'admin@pethotel.com', '1990-01-01', 'Other', 'Pet Hotel Main Office');

-- Note: Default password is 'admin123' - Please change it after first login!
