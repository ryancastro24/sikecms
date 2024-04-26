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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id("vehicle_id");
            $table->string("vin");
            $table->string("model_name");
            $table->string("body_type");
            $table->unsignedBigInteger("dealer_id");
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("option_id");
            $table->integer("price");
            $table->string("image");
            $table->timestamps();
            $table->foreign("dealer_id")->references("id")->on('users')->onDelete('cascade');
            $table->foreign("option_id")->references("option_id")->on('options')->onDelete('cascade');
            $table->foreign("brand_id")->references("brand_id")->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
