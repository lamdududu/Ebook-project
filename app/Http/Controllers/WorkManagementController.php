<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CopyrightProvider;
use App\Models\Account;
use App\Models\Category;
use App\Models\WorksCategories;
use App\Models\Work;
use App\Models\WorkStatus;
use Illuminate\Http\Request;

class WorkManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::all();
        $accounts = Account::whereIn('id', $works->pluck('tai_khoan_dang_tai'));
        $statuses = WorkStatus::whereIn('id', $works->pluck('trang_thai'));

        $data = work::join('accounts', 'works.tai_khoan_dang_tai', '=', 'accounts.id')
            ->join('work_statuses', 'works.trang_thai', '=', 'work_statuses.id')
            ->select('works.*', 'accounts.ten_tai_khoan', 'work_statuses.ten_trang_thai_tp')
            ->get();

        return view('work_management_views.work_management_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getWork($id)
    {
        $coverStoragePath = Storage::url('covers');
        $workStoragePath = Storage::url('works');

        $work = Work::find($id);

        $workCate = WorksCategories::where('tac_pham', $id)->get();
        $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

        $account = Account::find($work->tai_khoan_dang_tai);

        $status = WorkStatus::find($work->trang_thai);

        $copyright = CopyrightProvider::find($work->ban_quyen);


        return view('work_management_views.work_management_details', compact('work', 'coverStoragePath', 'workStoragePath', 'categories', 'copyright', 'status', 'account'));
    }

    public function edit(string $id)
    {
        $copyrights = CopyrightProvider::All();
        $statuses = WorkStatus::all();
        $categories = Category::all();
        
        if($id != 0) {
            $coverStoragePath = Storage::url('covers');
            $workStoragePath = Storage::url('works');

            $work = Work::find($id);

            $workCate = WorksCategories::where('tac_pham', $id)->pluck('the_loai')->toArray();
            // $categoriesOfWork = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

            $account = Account::find($work->tai_khoan_dang_tai);

            $status = WorkStatus::find($work->trang_thai);

            $copyright = CopyrightProvider::find($work->ban_quyen);
            

            return view('work_management_views.work_management', compact('work', 'coverStoragePath', 'workStoragePath', 'categories', 'copyright', 'status', 'account', 'copyrights', 'statuses', 'workCate'));
        }
        else {
            $work = [
                'tua_de' => '',
                'tac_gia' => '',
                'dich_gia' => '',
                'ngon_ngu' => '',
                'nha_xuat_ban' => '',
                'nam_xuat_ban' => '',
                'tong_bien_tap' => '',
                'bien_tap_vien' => '',
                'so_dkxb' => '',
                'so_qdxb' => '',
                'ngay_cap_qdxb' => '',
                'ma_so_isbn' => '',
                'tep_tin' => '',
                'anh_bia' => '',
                'mo_ta_noi_dung' => '',
                'tai_khoan_dang_tai' => '',
                'trang_thai' => '',
                'ban_quyen' => '',
            ];
            return view('work_management_views.work_management', compact('work', 'statuses', 'categories', 'copyrights'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fileCover' => 'image | mimes: jpeg, png, jpg | max: 2048',
            'titleWork' => 'required | string',
            'translator' => 'nullable | string',
            'author' => 'required | string',
            'language' => 'required | string',
            'publishYear' => 'required | integer',
            'dirEditor' => 'required | string',
            'editor' => 'required | string',
            'publisher' => 'required | string',
            'provider' => 'required',
            'dkxb' => 'required | string',
            'isbn'=> 'required | string',
            'qdxb' => 'required | string',
            'dkxbDate' => 'required | before: now',
            'categoryCheck.*' => 'required',
            'statusWork' => 'required',
            'fileWork' => 'file | mimes: docx, doc, txt, pdf'
        ]);

        $work = $request->all();
        Work::where('id', $id)->update($work);

        return redirect()->route('work.details')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
