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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('hoa_don')->nullable(false);
            $table->unsignedInteger('gia_thanh')->nullable(false);
            $table->char('phien_ban')->nullable(false);
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tac_pham')->references('id')->on('works');
            $table->foreign('hoa_don')->references('id')->on('bills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
