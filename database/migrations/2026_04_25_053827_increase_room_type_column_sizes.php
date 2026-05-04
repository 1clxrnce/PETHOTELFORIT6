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
        Schema::table('RoomTypes', function (Blueprint $table) {
            $table->string('typeName', 100)->change();
            $table->text('description')->change();
        });
    }

    public function down(): void
    {
        Schema::table('RoomTypes', function (Blueprint $table) {
            $table->string('typeName', 50)->change();
            $table->string('description', 255)->change();
        });
    }
};
