<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('Firstname');
        $table->string('Lastname');
        $table->string('phonenumber')->nullable();
        $table->string('city')->nullable();
        $table->string('email')->unique();
        $table->string('password');
        $table->string('verification_code')->nullable();
        $table->string('reset_code')->nullable();
        $table->string('gender')->nullable();
        $table->string('google_id')->nullable();
        $table->boolean('is_verified')->default(false);
        $table->string('role')->default('user');
        $table->timestamp('email_verified_at')->nullable();
        $table->timestamps(); // adds created_at and updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
