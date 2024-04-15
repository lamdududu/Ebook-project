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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();          
            $table->unsignedBigInteger('tai_khoan');
            $table->unsignedBigInteger('tac_pham');
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tai_khoan')->references('id')->on('accounts');
            $table->foreign('tac_pham')->references('id')->on('works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
