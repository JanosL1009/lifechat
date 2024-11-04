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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('sex')->nullable(); //1:nő, ferfi: 0
            $table->date('birthdate');
            $table->date('lastlogin')->nullable();
            $table->tinyInteger('is_vip')->nullable(); //1: igen VIP tag
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->text('hairColor')->nullable();
            $table->text('eyeColor')->nullable();
            $table->text('work')->nullable();
            $table->text('pet')->nullable();
            $table->integer('marital_status_id')->nullable(); //csaladi statusz 1: Egyedülálló, 2. Házas, 3. Párkapcsolatban, 4. Bonyolult, 5. Elvált, 6. Özvegy
            $table->string('email')->unique('email_index');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
