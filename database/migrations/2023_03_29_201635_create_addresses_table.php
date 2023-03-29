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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->nullable(false);
            $table->string('street_name')->nullable(false);
            $table->integer('building_number')->nullable(false);
            $table->integer('floor_number')->nullable(false);
            $table->integer('flat_number')->nullable(false);
            $table->boolean('is_main')->nullable(false);
            $table->unsignedBigInteger('client_id')->nullable(false);
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
