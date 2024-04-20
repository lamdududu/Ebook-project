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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ngay_lap')->nullable(false);
            $table->unsignedInteger('thanh_tien')->nullable(false);            
            $table->unsignedBigInteger('tai_khoan')->nullable(false);
            $table->unsignedBigInteger('khuyen_mai');
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tai_khoan')->references('id')->on('accounts');
            $table->foreign('khuyen_mai')->references('id')->on('promotions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
