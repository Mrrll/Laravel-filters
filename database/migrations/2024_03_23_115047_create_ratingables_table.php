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
        Schema::create('ratingables', function (Blueprint $table) {
            $table->unsignedBigInteger('ratingable_id');
            $table->string('ratingable_type');
            $table->unsignedBigInteger('rating_id');
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');
            $table->primary(['rating_id', 'ratingable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratingables');
    }
};
