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
        Schema::create('private_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('opener_user_id'); //annak a usernek az id-ja aki kezdemeneyzte a beszélgetést, tehat megnyitotta a szobat
            $table->integer('receiver_user_id'); //aki fogadja, tehat akire ra irtak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_rooms');
    }
};
