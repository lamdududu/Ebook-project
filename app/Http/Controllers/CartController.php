<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coverStoragePath = Storage::url('covers');

        $works = DB::select(
            'select w.id, w.tua_de, w.tac_gia, w.ngon_ngu, w.nha_xuat_ban, w.anh_bia, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem)
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= Now()
                GROUP BY w.id) b JOIN works w ON b.id = w.id
                            JOIN carts c ON c.tac_pham = w.id
            WHERE c.tai_khoan = ' . Session::get('user.id') . ';'
       );

        return view('account_views.cart', compact('works', 'coverStoragePath'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
