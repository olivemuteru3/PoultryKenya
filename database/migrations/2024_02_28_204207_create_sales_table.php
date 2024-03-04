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
            $table->id();
            $table->string('salesType');
            $table->string('price');
            $table->string('quantity');
            $table->string('total');
            $table->string('buyerName');
            $table->string('buyerPhone');
            $table->string('seller');
            $table->string('sellerPhone');
            $table->string('status')->default('sold');
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
