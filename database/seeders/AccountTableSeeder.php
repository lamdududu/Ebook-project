<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create('vi_VN');
        // foreach (range(1,10) as $i) {
        //     Account::create([
        //         'tenTaiKhoan' => $faker->userName(),
        //         'matKhau' => $faker->password(),
        //         'email' => $faker->unique()->email,
        //         'sdt' => $faker->regexify('[0-9]{10}'),
        //         'hoTenNguoiDung' => $faker->name,
        //         'ngaySinh' => $faker->date(),
        //         'gioiTinh' => $faker->boolean,
        //         'anhDaiDien' => $faker->text()
        //     ]);
        
        $password = Hash::Make('123456');

        $data = [
            [
                'ten_tai_khoan' => 'nva123',
                'mat_khau' => $password,
                'email' => 'nva@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Văn A',
                'ngay_sinh' => '2003-12-1',
                'gioi_tinh' => 0,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '1',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'ntb123',
                'mat_khau' => $password,
                'email' => 'ntb@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Thị B',
                'ngay_sinh' => '2002-02-27',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '2',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'nvc123',
                'mat_khau' => $password,
                'email' => 'nvc@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Văn C',
                'ngay_sinh' => '2000-3-3',
                'gioi_tinh' => 0,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '3',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'nvd123',
                'mat_khau' => $password,
                'email' => 'nvd@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Văn D',
                'ngay_sinh' => '2005-11-12',
                'gioi_tinh' => 0,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '3',
                'trang_thai' => '2'
            ],
            [
                'ten_tai_khoan' => 'nte123',
                'mat_khau' => $password,
                'email' => 'nve@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Thị E',
                'ngay_sinh' => '2003-7-12',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '2',
                'trang_thai' => '2'
            ],
            [
                'ten_tai_khoan' => 'ntf123',
                'mat_khau' => $password,
                'email' => 'nvf@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Thị F',
                'ngay_sinh' => '2001-5-21',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '1',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'ntg123',
                'mat_khau' => $password,
                'email' => 'nvg@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Thị G',
                'ngay_sinh' => '2003-6-12',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '3',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'nvh123',
                'mat_khau' => $password,
                'email' => 'nvh@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Văn H',
                'ngay_sinh' => '2004-3-1',
                'gioi_tinh' => 0,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '2',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'nti123',
                'mat_khau' => $password,
                'email' => 'nti@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Thị I',
                'ngay_sinh' => '1999-10-16',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '3',
                'trang_thai' => '1'
            ],
            [
                'ten_tai_khoan' => 'nvj123',
                'mat_khau' => $password,
                'email' => 'nvj@gmail.com',
                'so_dien_thoai' => '0123456789',
                'ho_ten_nguoi_dung' => 'Nguyễn Văn J',
                'ngay_sinh' => '1999-10-16',
                'gioi_tinh' => 1,
                'anh_dai_dien' => '',
                'loai_tai_khoan' => '3',
                'trang_thai' => '2'
            ],
        ];

        DB::table('accounts')->insert($data);
    }
}
