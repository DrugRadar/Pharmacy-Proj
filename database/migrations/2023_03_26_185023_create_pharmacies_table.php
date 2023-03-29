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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->nullable(false);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('national_id')->unique();
            $table->string('avatar_image');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
