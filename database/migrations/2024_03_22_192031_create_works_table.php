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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('tua_de', 250)->nullable(false);
            $table->string('tac_gia', 50)->nullable(false);
            $table->string('dich_gia', 50)->nullable(true);
            $table->string('ngon_ngu', 20)->nullable(false);
            $table->unsignedBigInteger('ban_quyen')->nullable(false);
            $table->unsignedBigInteger('nha_xuat_ban')->nullable(false);
            $table->integer('nam_xuat_ban')->nullable(false);
            $table->string('tong_bien_tap', 50)->nullable(false);
            $table->string('bien_tap_vien', 50)->nullable(false);
            $table->string('so_dkxb', 50)->nullable(false);
            $table->string('so_qdxb', 50)->nullable(false);
            $table->date('ngay_cap_qdxb')->nullable(false);
            $table->string('ma_so_isbn', 50)->nullable(false);
            $table->string('tep_tin', 250)->nullable(false);
            $table->string('anh_bia', 250)->nullable(false);
            $table->text('mo_ta_noi_dung')->nullable(false);
            $table->unsignedBigInteger('tai_khoan_dang_tai')->nullable(false);
            $table->unsignedBigInteger('trang_thai')->nullable(false);
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('tai_khoan_dang_tai')->references('id')->on('accounts');
            $table->foreign('trang_thai')->references('id')->on('work_statuses');
            $table->foreign('ban_quyen')->references('id')->on('copyright_providers');
            $table->foreign('nha_xuat_ban')->references('id')->on('publishers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
