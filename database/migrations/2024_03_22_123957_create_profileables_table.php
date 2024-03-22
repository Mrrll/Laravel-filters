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
        Schema::create('profileables', function (Blueprint $table) {
            $table->unsignedBigInteger('profileable_id');
            $table->string('profileable_type');
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->primary(['profileable_id', 'profileable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profileables');
    }
};
