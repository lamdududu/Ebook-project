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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('gia_thanh')->nullable(false);           
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('thoi_diem')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('tac_pham')->references('id')->on('works');
            $table->foreign('thoi_diem')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
