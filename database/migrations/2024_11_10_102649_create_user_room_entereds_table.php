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
        Schema::create('user_room_entereds', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id'); //ha isprivate 1-es akkor a private_rooms id kerul ide
            $table->integer('is_private'); //0: nem private 1:private
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_room_entereds');
    }
};
