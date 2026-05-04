<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Employee', 'Staff', 'Customer'])->default('Customer');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
        });

        Schema::create('Customers', function (Blueprint $table) {
            $table->id('cusID');
            $table->foreignId('userID')->nullable()->constrained('Users', 'userID')->onDelete('set null');
            $table->string('cusFName', 50);
            $table->string('cusMName', 50)->nullable();
            $table->string('cusLName', 50);
            $table->string('phoneNum', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
        });

        Schema::create('Employees', function (Blueprint $table) {
            $table->id('empID');
            $table->foreignId('userID')->nullable()->constrained('Users', 'userID')->onDelete('set null');
            $table->string('empFName', 50);
            $table->string('empMName', 50)->nullable();
            $table->string('empLName', 50);
            $table->string('phoneNum', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->text('address')->nullable();
        });

        Schema::create('Pets', function (Blueprint $table) {
            $table->id('petID');
            $table->foreignId('cusID')->constrained('Customers', 'cusID')->onDelete('cascade');
            $table->string('petName', 100);
            $table->string('petPhoto')->nullable();
            $table->string('petType', 50)->nullable();
            $table->string('breed', 100)->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('birthdate')->nullable();
            $table->string('weightSize', 50)->nullable();
            $table->string('vaccinationFile')->nullable();
        });

        Schema::create('RoomTypes', function (Blueprint $table) {
            $table->id('roomTypeID');
            $table->string('typeName', 100);
            $table->text('description')->nullable();
            $table->decimal('pricePerNight', 10, 2)->default(0);
            $table->integer('maxCapacity')->default(1);
        });

        Schema::create('Rooms', function (Blueprint $table) {
            $table->id('roomID');
            $table->foreignId('roomTypeID')->constrained('RoomTypes', 'roomTypeID')->onDelete('cascade');
            $table->string('roomNum', 20)->unique();
            $table->string('roomPhoto')->nullable();
            $table->enum('status', ['Available', 'Occupied', 'Maintenance'])->default('Available');
        });

        Schema::create('Bookings', function (Blueprint $table) {
            $table->id('bookingID');
            $table->foreignId('cusID')->constrained('Customers', 'cusID')->onDelete('cascade');
            $table->foreignId('petID')->constrained('Pets', 'petID')->onDelete('cascade');
            $table->foreignId('roomID')->constrained('Rooms', 'roomID')->onDelete('cascade');
            $table->foreignId('empID')->nullable()->constrained('Employees', 'empID')->onDelete('set null');
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->decimal('totalAmount', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Confirmed', 'Checked In', 'Checked Out', 'Cancelled'])->default('Pending');
        });

        Schema::create('AddOns', function (Blueprint $table) {
            $table->id('addOnID');
            $table->string('addOnName', 100);
            $table->decimal('price', 10, 2)->default(0);
        });

        Schema::create('BookingAddOns', function (Blueprint $table) {
            $table->foreignId('bookingID')->constrained('Bookings', 'bookingID')->onDelete('cascade');
            $table->foreignId('addOnID')->constrained('AddOns', 'addOnID')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->primary(['bookingID', 'addOnID']);
        });

        Schema::create('Payments', function (Blueprint $table) {
            $table->id('paymentID');
            $table->unsignedBigInteger('bookingID');
            $table->foreign('bookingID', 'fk_payments_booking')->references('bookingID')->on('Bookings')->onDelete('cascade');
            $table->unique('bookingID', 'uq_payments_booking');
            $table->date('paymentDate')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('paymentMethod', 50)->nullable();
            $table->enum('paymentStatus', ['Paid', 'Partial', 'Unpaid'])->default('Unpaid');
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('Payments');
        Schema::dropIfExists('BookingAddOns');
        Schema::dropIfExists('AddOns');
        Schema::dropIfExists('Bookings');
        Schema::dropIfExists('Rooms');
        Schema::dropIfExists('RoomTypes');
        Schema::dropIfExists('Pets');
        Schema::dropIfExists('Employees');
        Schema::dropIfExists('Customers');
        Schema::dropIfExists('Users');
    }
};
