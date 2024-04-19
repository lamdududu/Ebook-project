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
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WorkManagementController extends Controller
{
    /**
     * Hiển thị danh sách tác phẩm (toàn bộ) ở giao diện của biên tập viên.
     * route('work.management')
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

        return view('work_management_views.full-list', compact('data'));
    }

    /**
     * Hiển thị chi tiết của một tác phẩm ở giao diện của biên tập viên.
     * route('work.details')
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


        return view('details', compact('work', 'coverStoragePath', 'workStoragePath', 'categories', 'copyright', 'status', 'account'));
    }

    /**
     * Giao diện tạo tác phẩm
     * route('work.new')
    */
    public function createNewWork()
    {
        $copyrights = CopyrightProvider::All();
        $statuses = WorkStatus::all();
        $categories = Category::all();
            
        return view('work_management_views.create', compact('categories', 'copyrights', 'statuses'));
    }

    /**
     * Lưu tác phẩm đã tạo
     * route('work.create')
    */
    public function create(Request $request)
    {
        $request->validate(
            [
                'fileCover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'titleWork' => 'required|string',
                'translator' => 'nullable|string',
                'author' => 'required|string',
                'language' => 'required|string',
                // kiểm tra năm xuất bản phải nhỏ hơn hoặc bằng năm hiện tại
                'publishYear' => 'required|integer|lte:'. date('Y'),
                'dirEditor' => 'required|string',
                'editor' => 'required|string',
                'publisher' => 'required|string',
                'provider' => 'required',
                'dkxb' => 'required|string',
                'isbn'=> 'required|string',
                'qdxb' => 'required|string',
                'qdxbDate' => 'required|before: now',
                // kiểm tra mảng categoryCheck có ít nhất 1 phần tử (có ít nhất 1 thể loại được chọn)
                'categoryCheck' => 'required|array|min:1',
                // 'categoryCheck.*' => 'accepted',
                'statusWork' => 'required',
                'fileWork' => 'required|file|mimes:docx,doc,txt,pdf|max:20480',
                'summary' => 'required|string',
            ],
            [
                'fileCover.required' => 'Chưa tải lên ảnh bìa',
                'fileCover.image' => 'Không phải tệp tin hình ảnh (.jpeg, .png, .jpg)',
                'fileCover.mimes' => 'Không phải tệp tin hình ảnh (.jpeg, .png, .jpg)',
                'fileCover.max' => 'Kích thước ảnh quá lớn',
                'titleWork.required' => 'Chưa nhập tựa đề',
                'titleWork.string' => 'Tựa đề sai định dạng',
                'translator.string' => 'Nhập sai định dạng',
                'author.required' => 'Chưa nhập tên tác giả',
                'author.string' => 'Tên tác giả sai định dạng',
                'language.required' => 'Chưa nhập ngôn ngữ',
                'language.string' => 'Ngôn ngữ sai định dạng',
                'publishYear.required' => 'Chưa nhập năm xuất bản',
                'publishYear.integer' => 'Năm xuất bản sai định dạng',
                'publishYear.lte' => 'Dường như đã xảy ra nhầm lần về năm xuất bản, vui lòng kiểm tra lại',
                'dirEditor.required' => 'Chưa nhập tên tổng biên tập',
                'dirEditor.string' => 'Tên tổng biên tập sai định dạng',
                'editor.required' => 'Chưa nhập tên biên tập',
                'editor.string' => 'Tên biên tập sai định dạng',
                'publisher.required' => 'Chưa nhập tên nhà xuất bản',
                'publisher.string' => 'Tên nhà xuất bản sai định dạng',
                'provider.required' => 'Chưa chọn nhà cung cấp bản quyền',
                'dkxb.required' => 'Chưa nhập số đăng ký xuất bản',
                'dkxb.string' => 'Số đăng ký xuất bản sai định dạng',
                'isbn.required' => 'Chưa nhập mã số ISBN',
                'isbn.string' => 'Mã số ISBN sai định dạng',
                'qdxb.required' => 'Chưa nhập số quyết định xuất bản',
                'qdxb.string' => 'Số quyết định xuất bản sai định dạng',
                'qdxbDate.required' => 'Chưa nhập ngày quyết định xuất bản',
                'qdxbDate.before' => 'Dường như có sự nhầm lẫn về ngày quyết định xuất bản, vui lòng kiểm tra lại',
                'categoryCheck.required' => 'Chưa chọn thể loại',
                'categoryCheck.array' => 'Chưa chọn thể loại',
                'categoryCheck.min' => 'Chưa chọn thể loại',
                'statusWork.required' => 'Chưa chọn trạng thái',
                'fileWork.mimes' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.required' => 'Chưa tải lên tệp tác phẩm',
                'fileWork.file' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'summary.required' => 'Chưa nhập mô tả nội dung tác phẩm',
                'summary.string' => 'Mô tả nội dung sai định dạng',
            ]
        );

        if($request->file('fileCover')) {
            $fileCover = $request['fileCover'];
            
            // lấy tên file
            $fileNameCover = str_replace(' ', '', $fileCover->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileCover->storeAs('public/covers', $fileNameCover);
        }

        if($request->file('fileWork')) {
            $fileWork = $request['fileWork'];
            
            // lấy tên file
            $fileNameWork = str_replace(' ', '', $fileWork->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileWork->storeAs('public/works', $fileNameWork);
        }

        

        $work = Work::create(
            [
                'tua_de' => $request->input('titleWork'),
                'tac_gia' => $request->input('author'),
                'dich_gia' => $request->input('translator'),
                'ngon_ngu' => $request->input('language'),
                'nam_xuat_ban'  => $request->input('publishYear'),
                'nha_xuat_ban'=> $request->input('publisher'),
                'tong_bien_tap' => $request->input('dirEditor'),
                'bien_tap_vien' => $request->input('editor'),
                'so_dkxb' => $request->input('dkxb'),
                'so_qdxb' => $request->input('qdxb'),
                'ngay_cap_qdxb' => Carbon::parse($request->input('qdxbDate'))->format('Y-m-d'),
                'ma_so_isbn' => $request->input('isbn'),
                'anh_bia' => $fileNameCover,
                'tep_tin' => $fileNameWork,
                'mo_ta_noi_dung' => $request->input('summary'),
                'tai_khoan_dang_tai' => Session::get('user')->id,
                'ban_quyen' => $request->input('provider'),
                'trang_thai' => $request->input('statusWork'),
            ]
        );

        foreach($request->input('categoryCheck', []) as $category) {
            WorksCategories::create([
                'tac_pham' => $work->id,
                'the_loai' => $category,
            ]);
        }

        return redirect()->route('work.details', ['id' => $work->id])->with('success', 'Cập nhật thành công');
    }

    /**
     * Giao diện chỉnh sửa tác phẩm
     * route('work.edit')
     */
    public function edit(string $id)
    {
        // lấy danh sách nhà cung cấp bản quyền, thể loại, trạng thái
        $copyrights = CopyrightProvider::All();
        $statuses = WorkStatus::all();
        $categories = Category::all();
        
        // lấy đường dẫn tới thư mục chứa ảnh bìa
        $coverStoragePath = Storage::url('covers');

        // lấy thông tin tác phẩm
        $work = Work::find($id);
        $workCate = WorksCategories::where('tac_pham', $id)->pluck('the_loai')->toArray();
        $account = Account::find($work->tai_khoan_dang_tai);
        $status = WorkStatus::find($work->trang_thai);
        $copyright = CopyrightProvider::find($work->ban_quyen);
            

        return view('work_management_views.edit', compact('work', 'coverStoragePath', 'categories', 'copyright', 'status', 'account', 'copyrights', 'statuses', 'workCate'));
    }

    /**
     * Cập nhật thông tin tác phẩm
     * route('work.update')
     */ 
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'fileCover' => 'nullable|image|mimes:jpeg,png,jpg|max: 2048',
                'titleWork' => 'required|string',
                'translator' => 'nullable|string',
                'author' => 'required|string',
                'language' => 'required|string',
                // kiểm tra năm xuất bản phải nhỏ hơn hoặc bằng năm hiện tại
                'publishYear' => 'required|integer|lte:'. date('Y'),
                'dirEditor' => 'required|string',
                'editor' => 'required|string',
                'publisher' => 'required|string',
                'provider' => 'required',
                'dkxb' => 'required|string',
                'isbn'=> 'required|string',
                'qdxb' => 'required|string',
                'qdxbDate' => 'required|before: now',
                // kiểm tra mảng categoryCheck có ít nhất 1 phần tử (có ít nhất 1 thể loại được chọn)
                'categoryCheck' => 'required|array|min:1',
                // 'categoryCheck.*' => 'accepted',
                'statusWork' => 'required',
                'fileWork' => 'nullable|file|mimes:docx,doc,txt,pdf|max:20480',
                'summary' => 'required|string',
            ],
            [
                'fileCover.image' => 'Không phải tệp tin hình ảnh (.jpeg, .png, .jpg)',
                'fileCover.mimes' => 'Không phải tệp tin hình ảnh (.jpeg, .png, .jpg)',
                'fileCover.max' => 'Kích thước ảnh quá lớn',
                'titleWork.required' => 'Chưa nhập tựa đề',
                'titleWork.string' => 'Tựa đề sai định dạng',
                'translator.string' => 'Nhập sai định dạng',
                'author.required' => 'Chưa nhập tên tác giả',
                'author.string' => 'Tên tác giả sai định dạng',
                'language.required' => 'Chưa nhập ngôn ngữ',
                'language.string' => 'Ngôn ngữ sai định dạng',
                'publishYear.required' => 'Chưa nhập năm xuất bản',
                'publishYear.integer' => 'Năm xuất bản sai định dạng',
                'publishYear.lte' => 'Dường như đã xảy ra nhầm lần về năm xuất bản, vui lòng kiểm tra lại',
                'dirEditor.required' => 'Chưa nhập tên tổng biên tập',
                'dirEditor.string' => 'Tên tổng biên tập sai định dạng',
                'editor.required' => 'Chưa nhập tên biên tập',
                'editor.string' => 'Tên biên tập sai định dạng',
                'publisher.required' => 'Chưa nhập tên nhà xuất bản',
                'publisher.string' => 'Tên nhà xuất bản sai định dạng',
                'provider.required' => 'Chưa chọn nhà cung cấp bản quyền',
                'dkxb.required' => 'Chưa nhập số đăng ký xuất bản',
                'dkxb.string' => 'Số đăng ký xuất bản sai định dạng',
                'isbn.required' => 'Chưa nhập mã số ISBN',
                'isbn.string' => 'Mã số ISBN sai định dạng',
                'qdxb.required' => 'Chưa nhập số quyết định xuất bản',
                'qdxb.string' => 'Số quyết định xuất bản sai định dạng',
                'qdxbDate.required' => 'Chưa nhập ngày quyết định xuất bản',
                'qdxbDate.before' => 'Dường như có sự nhầm lẫn về ngày quyết định xuất bản, vui lòng kiểm tra lại',
                'categoryCheck.required' => 'Chưa chọn thể loại',
                'categoryCheck.array' => 'Chưa chọn thể loại',
                'categoryCheck.min' => 'Chưa chọn thể loại',
                'statusWork.required' => 'Chưa chọn trạng thái',
                'fileWork.file' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.mimes' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.max' => 'Kích thước tệp tác phẩm quá lớn',
                'summary.required' => 'Chưa nhập mô tả nội dung tác phẩm',
                'summary.string' => 'Mô tả nội dung sai định dạng',
            ]
        );

        if($request->file('fileCover')) {
            $fileCover = $request['fileCover'];
            
            // lấy tên file
            $fileNameCover = str_replace(' ', '', $fileCover->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileCover->storeAs('public/covers', $fileNameCover);

            $work['anh_bia'] = $fileNameCover;
        }

        if($request->file('fileWork')) {
            $fileWork = $request['fileWork'];
            
            // lấy tên file
            $fileNameWork = str_replace(' ', '', $fileWork->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileWork->storeAs('public/works', $fileNameWork);

            $work['tep_tin'] = $fileNameWork;
        }

        // $work = new Work;

        $work = [
            'tua_de' => $request->input('titleWork'),
            'tac_gia' => $request->input('author'),
            'dich_gia' => $request->input('translator'),
            'ngon_ngu' => $request->input('language'),
            'nam_xuat_ban'  => $request->input('publishYear'),
            'nha_xuat_ban'=> $request->input('publisher'),
            'tong_bien_tap' => $request->input('dirEditor'),
            'bien_tap_vien' => $request->input('editor'),
            'so_dkxb' => $request->input('dkxb'),
            'so_qdxb' => $request->input('qdxb'),
            'ngay_cap_qdxb' => Carbon::parse($request->input('qdxbDate'))->format('Y-m-d'),
            'ma_so_isbn' => $request->input('isbn'),
            'mo_ta_noi_dung' => $request->input('summary'),
            'ban_quyen' => $request->input('provider'),
        ];

        Work::where('id', $id)->update($work);

        // xóa các thể loại cũ
        WorksCategories::where('tac_pham', $id)->delete();

        // Thêm thể loại vừa chọn
        foreach($request->input('categoryCheck', []) as $category) {
            WorksCategories::create([
                'tac_pham' => $id,
                'the_loai' => $category,
            ]);
        }

        return redirect()->route('work.details', ['id' => $id])->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getWorksWithPrices()
    {
        // $works = DB::select(
        //     'SELECT w.id, w.tua_de, a.ten_tai_khoan, s.ten_trang_thai_tp, b.gia_thanh, b.thoi_diem
        //     FROM works w
        //     LEFT JOIN (
        //         SELECT p.tac_pham, p.gia_thanh, t.thoi_diem
        //         FROM prices p
        //         LEFT JOIN times t ON p.thoi_diem = t.id
        //         GROUP BY p.tac_pham
        //     ) b ON w.id = b.tac_pham
        //     LEFT JOIN accounts a ON w.tai_khoan_dang_tai = a.id
        //     LEFT JOIN work_statuses s ON w.trang_thai = s.id;'
        // );

        $works = Work::leftJoin('prices as p', 'p.tac_pham', '=', 'works.id')
                        ->leftJoin('times as t', 'p.thoi_diem', '=', 't.id')
                        ->leftJoin('accounts as a', 'works.tai_khoan_dang_tai', '=', 'a.id')
                        ->leftJoin('work_statuses as s', 'works.trang_thai', '=', 's.id')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan', 's.ten_trang_thai_tp', 'p.gia_thanh', 't.thoi_diem')
                        ->get();

        return view('work_management_views.prices', compact('works'));
    }
}
