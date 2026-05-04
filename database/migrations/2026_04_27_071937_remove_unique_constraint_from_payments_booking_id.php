<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Payments', function (Blueprint $table) {
            $table->dropForeign('fk_payments_booking');
            $table->dropUnique('uq_payments_booking');
            $table->index('bookingID');
            $table->foreign('bookingID', 'fk_payments_booking')
                  ->references('bookingID')->on('Bookings')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('Payments', function (Blueprint $table) {
            $table->dropForeign('fk_payments_booking');
            $table->dropIndex(['bookingID']);
            $table->unique('bookingID', 'uq_payments_booking');
            $table->foreign('bookingID', 'fk_payments_booking')
                  ->references('bookingID')->on('Bookings')
                  ->onDelete('cascade');
        });
    }
};
