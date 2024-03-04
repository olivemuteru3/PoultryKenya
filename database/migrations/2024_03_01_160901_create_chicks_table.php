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
        Schema::create('chicks', function (Blueprint $table) {
            $table->id();
            $table->string('farmerName');
            $table->string('farmerPhone');
            $table->string('chick_number');
            $table->string('date');
            $table->text('comments');
            $table->string('status')->default('entered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chicks');
    }
};
