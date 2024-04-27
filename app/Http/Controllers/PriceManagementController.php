<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Time;
use App\Models\Work;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PriceManagementController extends Controller
{
    /**
     * Giao diện tạo giá mới
     * route('prices.new')
     */
    public function createNewPrices() {
        $works = Work::leftJoin('prices as p', 'p.tac_pham', '=', 'works.id')
                        ->leftJoin('times as t', 'p.thoi_diem', '=', 't.id')
                        ->leftJoin('accounts as a', 'works.tai_khoan_dang_tai', '=', 'a.id')
                        ->leftJoin('work_statuses as s', 'works.trang_thai', '=', 's.id')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan', 's.ten_trang_thai_tp', 'p.gia_ban_thuong', 'p.gia_ban_db', 't.thoi_diem')
                        ->get();

        return view('work_management_views.new-price', compact('works'));
    }

    /**
     * lưu giá mới
     * route('prices.create')
     */
    public function create(Request $request) {
        $request->validate(
            [
                'normalPrice' => 'required|integer|min:1000',
                'specialPrice' => 'required|integer|min:1000',
                'priceDate' => 'required',
                'workCheck' => 'required|array|min:1',
            ],
            [
                'normalPrice.required' => 'Chưa nhập giá bán',
                'normalPrice.integer' => 'Sai định dạng giá',
                'normalPrice.min' => 'Giá bán ít nhất là 1000 VND',
                'specialPrice.required' => 'Chưa nhập giá bán',
                'specialPrice.integer' => 'Sai định dạng giá',
                'specialPrice.min' => 'Giá bán ít nhất là 1000 VND',
                'priceDate.required' => 'Chưa nhập ngày giá bán bắt đầu có hiệu lực',
                'workCheck.required' => 'Chưa chọn tác phẩm',
                'workCheck.array' => 'Chưa chọn tác phẩm',
                'workCheck.min' => 'Chưa chọn tác phẩm',
            ]
        );

        $time = Time::create(['thoi_diem' => Carbon::parse($request->input('priceDate'))->format('y-m-d')]);

        foreach($request->input('workCheck', []) as $work) {
            Price::create([
                'gia_ban_thuong' => $request->input('normalPrice'),
                'gia_ban_db' => $request->input('specialPrice'),
                'thoi_diem' => $time->id,
                'tac_pham' => $work,
            ]);
        }

        return redirect()->route('prices.new')->with('success', 'Tạo giá bán mới thành công.');
    }
}
