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
        Schema::create('copyright_providers', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nha_cung_cap', 250)->nullable(false);
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
        Schema::dropIfExists('copyright_providers');
    }
};
