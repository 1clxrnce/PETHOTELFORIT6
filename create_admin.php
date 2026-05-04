<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

// Check if admin already exists
$existingAdmin = User::where('username', 'admin')->first();
if ($existingAdmin) {
    echo "Admin account already exists!\n";
    exit;
}

// Create admin user
$user = User::create([
    'username' => 'admin',
    'password' => Hash::make('admin123'),
    'role' => 'Admin',
    'status' => 'Active',
]);

// Create admin employee profile
Employee::create([
    'userID' => $user->userID,
    'empFName' => 'System',
    'empLName' => 'Administrator',
    'phoneNum' => '09000000000',
    'email' => 'admin@pethotel.com',
    'birthdate' => '1990-01-01',
    'gender' => 'Other',
    'address' => 'Pet Hotel Main Office',
]);

echo "Admin account created successfully!\n";
echo "Username: admin\n";
echo "Password: admin123\n";
echo "Please change the password after first login!\n";
