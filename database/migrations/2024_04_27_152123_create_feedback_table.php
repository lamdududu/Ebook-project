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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('tai_khoan')->nullable(false);
            $table->text('noi_dung_phan_hoi')->nullable(False);
            $table->timestamps();

            // Khoá ngoại
            $table->foreign('tac_pham')->references('id')->on('works');
            $table->foreign('tai_khoan')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
