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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->enum('gender', ['male', 'female'])->nullable(false);
            $table->string('password')->nullable(false);
            $table->date('date_of_birth')->nullable(false);
            $table->string('national_id')->nullable(false)->unique();
            $table->string('mobile_number')->nullable(false);
            $table->string('avatar_image')->nullable(false);
            $table->timestamp('last_visit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
