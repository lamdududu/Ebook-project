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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('ten_chuong_trinh', 250)->nullable(false);
            $table->dateTime('ngay_bat_dau')->nullable(false);
            $table->dateTime('ngay_ket_thuc')->nullable(false);
            $table->float('ti_le_khuyen_mai')->nullable(false);
            $table->string('mo_ta_khuyen_mai', 250);
            $table->unsignedBigInteger('nguoi_tao')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('nguoi_tao')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
