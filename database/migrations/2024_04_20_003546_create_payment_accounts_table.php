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
        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('so_tai_khoan', 20)->nullable(false)->unique();
            $table->string('mat_khau', 30)->nullable(false);
            $table->unsignedBigInteger('tai_khoan')->nullable(false);
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tai_khoan')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_accounts');
    }
};