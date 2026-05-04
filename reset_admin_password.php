<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Find admin user
$admin = User::where('username', 'admin')->first();

if (!$admin) {
    echo "Admin account not found!\n";
    exit;
}

// Reset password
$admin->password = Hash::make('admin123');
$admin->save();

echo "Admin password reset successfully!\n";
echo "Username: admin\n";
echo "Password: admin123\n";
