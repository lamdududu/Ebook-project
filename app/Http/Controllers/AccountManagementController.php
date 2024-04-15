<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\AccountType;

class AccountManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $accounts = Account::where('loai_tai_khoan', 3)->get();
        // $statuses = AccountStatus::whereIn('id', $accounts->pluck('trang_thai'));

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', 3)
                        ->get();

        return view('account_management_views.accounts_management_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAdminAccounts()
    {
        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', '1')
                        ->get();

        return view('account_management_views.accounts_management_list', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getEditorAccounts()
    {
        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', 2)
                        ->get();

        return view('account_management_views.accounts_management_list', compact('data'));
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
