<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Validator::extend('exists_in_database', function ($attribute, $value, $parameters, $validator) {
        //     $table = $parameters[0]; // Tên bảng trong cơ sở dữ liệu
        //     $column = $parameters[1]; // Tên cột trong bảng
        //     return DB::table($table)->where($column, $value)->exists();
        // });
        
        // Validator::replacer('exists_in_database', function ($message, $attribute, $rule, $parameters) {
        //     // Thay thế thông báo lỗi tương ứng
        //     return str_replace(':attribute', $attribute, ':attribute không tồn tại');
        // });

        // Validator::extend('password_to_check', function ($attribute, $value, $parameters, $validator) {
        //     $table = $parameters[0]; // Tên bảng trong cơ sở dữ liệu
        //     $column = $parameters[1]; // Tên cột trong bảng
        //     $hashedPassword = DB::table($table)->where($column, $value)->value('mat_khau');
        //     return (Hash::check($value, $hashedPassword));
        // });

        // Validator::replacer('password_to_check', function ($message, $attribute, $rule, $parameters) {
        //     // Thay thế thông báo lỗi tương ứng
        //     return str_replace(':attribute', $attribute, 'Sai mật khẩu');
        // });
    }
}
