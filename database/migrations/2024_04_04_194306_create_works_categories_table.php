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
        Schema::create('works_categories', function (Blueprint $table) {
            $table->id();           
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('the_loai')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('tac_pham')->references('id')->on('works');
            $table->foreign('the_loai')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works_categories');
    }
};
