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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tai_khoan',30)->nullable(false)->unique();
            $table->string('mat_khau',30)->nullable(false);
            $table->string('email',50)->unique()->nullable(false);
            $table->char('so_dien_thoai',10)->nullable(false);
            $table->string('ho_ten_nguoi_dung', 50)->nullable(false);
            $table->date('ngay_sinh')->nullable(false);
            $table->boolean('gioi_tinh');
            $table->string('anh_dai_dien');
            $table->unsignedBigInteger('loai_tai_khoan')->nullable(false);
            $table->unsignedBigInteger('trang_thai')->nullable(false);
            $table->timestamps();

            //Khoá ngoại
            $table->foreign('loai_tai_khoan')->references('id')->on('account_types');
            $table->foreign('trang_thai')->references('id')->on('account_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
