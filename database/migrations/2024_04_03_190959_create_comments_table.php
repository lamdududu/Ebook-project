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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('noi_dung_binh_luan')->nullable(false);           
            $table->unsignedBigInteger('tai_khoan')->nullable(false);
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('tai_khoan')->references('id')->on('accounts');
            $table->foreign('tac_pham')->references('id')->on('works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
