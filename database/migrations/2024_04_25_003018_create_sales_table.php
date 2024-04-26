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
        Schema::create('sales', function (Blueprint $table) {
            $table->id("sale_id");
            $table->unsignedBigInteger("inventory_id");
            $table->unsignedBigInteger("customer_id");
            $table->foreign("inventory_id")->references("inventory_id")->on('inventories')->onDelete('cascade');
            $table->foreign("customer_id")->references("id")->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
