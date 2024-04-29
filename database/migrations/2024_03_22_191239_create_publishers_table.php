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
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('nha_xuat_ban', 256)->nullable(false)->unique();
            $table->char('so_dien_thoai', 10)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->string('dia_chi', 100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
