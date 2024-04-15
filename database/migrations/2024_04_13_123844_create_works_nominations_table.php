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
        Schema::create('works_nominations', function (Blueprint $table) {
            $table->id();           
            $table->unsignedBigInteger('tac_pham')->nullable(false);
            $table->unsignedBigInteger('de_cu')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('tac_pham')->references('id')->on('works')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('de_cu')->references('id')->on('nominations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works_nominations');
    }
};
