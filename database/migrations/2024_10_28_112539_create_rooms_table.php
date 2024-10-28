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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('picture')->nullable();
            $table->string('number_of_employees'); //letszam, az aktualisa szobaban
            $table->string('describe');
            $table->tinyInteger('status')->nullable(); // null vagy 1: nem megjelenithető, 1: nyitva; 2-es: zárva e megjelenhet, nem léphet be senki; 3-as zárva, nem jelenik meg és nem léphet be senki
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
