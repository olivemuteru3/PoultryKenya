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
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('feedName');
            $table->string('quantity');
            $table->string('supplier');
            $table->string('purchaseDate');
            $table->text('comments');
            $table->string('enteredBy');
            $table->string('cashierPhone');
            $table->string('status')->default('added');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
