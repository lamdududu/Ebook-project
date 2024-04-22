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
        $statuses = AccountStatus::All();

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', 3)
                        ->get();

        return view('account_management_views.user', compact('data', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAdminAccounts()
    {
        $statuses = AccountStatus::All();

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', '1')
                        ->get();

        return view('account_management_views.user', compact('data', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getEditorAccounts()
    {
        $statuses = AccountStatus::All();

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.loai_tai_khoan', 2)
                        ->get();

        return view('account_management_views.user', compact('data', 'statuses'));
    }

    public function getNormalAccount()
    {
        $statuses = AccountStatus::All();

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.trang_thai', 1)
                        ->get();

        return view('account_management_views.user', compact('data', 'statuses'));
    }

    public function getBlockedAccount()
    {
        $statuses = AccountStatus::All();

        $data = Account::join('account_statuses', 'accounts.trang_thai', '=', 'account_statuses.id')
                        ->select('accounts.*', 'account_statuses.ten_trang_thai')
                        ->where('accounts.trang_thai', 2)
                        ->get();

        return view('account_management_views.user', compact('data', 'statuses'));
    }

    public function updateAccountStatus(Request $request)
    {
        $request->validate(
            [
                'accountCheck' => 'required|array|min:1',
            ],
            [
                'accountCheck' => 'Chọn ít nhất 1 tài khoản để thực hiện thao tác',
            ]
        );

        // Kiểm tra thao tác được chọn (edit, block, unblock)
        if($request->has('edit')) {
    
            foreach($request->input('accountCheck', []) as $check) {
                Account::where('id', $check)->update(['trang_thai' => $request->input('status')[$check]]);
            }
            
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        }

        else {
            if($request->has('block')) {
                $status = 2;
            }
            else {
                $status = 1;
            }
    
            foreach($request->input('accountCheck', []) as $check) {
                Account::where('id', $check)->update(['trang_thai' => $status]);
            }
    
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        }

    }
}
