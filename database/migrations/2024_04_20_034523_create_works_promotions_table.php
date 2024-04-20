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
        Schema::create('works_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('khuyen_mai')->nullable(false);
            $table->float('ti_le_khuyen_mai')->nullable(false);
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tac_pham')->references('id')->on('works');
            $table->foreign('khuyen_mai')->references('id')->on('promotions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works_promotions');
    }
};
