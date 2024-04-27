<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CopyrightProvider;
use App\Models\Account;
use App\Models\Category;
use App\Models\Price;
use App\Models\Publisher;
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
        // $works = Work::all();
        // $accounts = Account::whereIn('id', $works->pluck('tai_khoan_dang_tai'));
        // $statuses = WorkStatus::whereIn('id', $works->pluck('trang_thai'));

        $data = work::join('accounts', 'works.tai_khoan_dang_tai', '=', 'accounts.id')
            ->join('work_statuses', 'works.trang_thai', '=', 'work_statuses.id')
            ->join('publishers', 'works.nha_xuat_ban', '=', 'publishers.id')
            ->select('works.*', 'publishers.nha_xuat_ban', 'accounts.ten_tai_khoan', 'work_statuses.ten_trang_thai_tp')
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

        $publisher = Publisher::find($work->nha_xuat_ban);

        return view('work_management_views.details', compact('publisher', 'work', 'coverStoragePath', 'workStoragePath', 'categories', 'copyright', 'status', 'account'));
    }

    public function getPublicWork() {
        $data = work::join('accounts', 'works.tai_khoan_dang_tai', '=', 'accounts.id')
            ->join('work_statuses', 'works.trang_thai', '=', 'work_statuses.id')
            ->join('publishers', 'works.nha_xuat_ban', '=', 'publishers.id')
            ->where('works.trang_thai', 1)
            ->select('works.*', 'publishers.nha_xuat_ban', 'accounts.ten_tai_khoan', 'work_statuses.ten_trang_thai_tp')
            ->get();

        return view('work_management_views.full-list', compact('data'));
    }

    public function getHiddenWork() {
        $data = work::join('accounts', 'works.tai_khoan_dang_tai', '=', 'accounts.id')
            ->join('work_statuses', 'works.trang_thai', '=', 'work_statuses.id')
            ->join('publishers', 'works.nha_xuat_ban', '=', 'publishers.id')
            ->where('works.trang_thai', 2)
            ->select('works.*', 'publishers.nha_xuat_ban', 'accounts.ten_tai_khoan', 'work_statuses.ten_trang_thai_tp')
            ->get();

        return view('work_management_views.full-list', compact('data'));
    }

    public function getApprovingWork() {
        $data = work::join('accounts', 'works.tai_khoan_dang_tai', '=', 'accounts.id')
            ->join('work_statuses', 'works.trang_thai', '=', 'work_statuses.id')
            ->join('publishers', 'works.nha_xuat_ban', '=', 'publishers.id')
            ->where('works.trang_thai', 3)
            ->select('works.*', 'publishers.nha_xuat_ban', 'accounts.ten_tai_khoan', 'work_statuses.ten_trang_thai_tp')
            ->get();

        return view('work_management_views.full-list', compact('data'));
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
        $publishers = Publisher::all();
            
        return view('work_management_views.create', compact('publishers', 'categories', 'copyrights', 'statuses'));
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
                'chosenPublisher' => 'required',
                'chosenProvider' => 'required',
                'dkxb' => 'required|string',
                'isbn'=> 'required|string',
                'qdxb' => 'required|string',
                'qdxbDate' => 'required|before: now',
                // kiểm tra mảng categoryCheck có ít nhất 1 phần tử (có ít nhất 1 thể loại được chọn)
                'categoryCheck' => 'required|array|min:1',
                // 'categoryCheck.*' => 'accepted',
                // 'statusWork' => 'required',
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
                // 'statusWork.required' => 'Chưa chọn trạng thái',
                'fileWork.mimes' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.required' => 'Chưa tải lên tệp tác phẩm',
                'fileWork.file' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'summary.required' => 'Chưa nhập mô tả nội dung tác phẩm',
                'summary.string' => 'Mô tả nội dung sai định dạng',
                'chosenPublisher.required' => 'Tác phẩm phải có nhà xuất bản',
                'chosenProvider.required' => 'Tác phẩm phải có đơn vị cung cấp bản quyền',
            ]
        );

        // Kiểm tra thể loại
        foreach($request->input('categoryCheck', []) as $category) {
            if($category == -1) {
               $request->validate(
                    [
                        'otherCategories' => 'required|regex:/^[\p{L},\s]+$/u',
                    ],
                    [
                        'otherCategories.required' => 'Chưa nhập thể loại mới',
                        'otherCategories.regex' => 'Tên (các) thể loại sai định dạng',
                    ]
                );
            }
        }

        // Kiểm tra nhà xuất bản
        if($request->input('chosenPublisher') == 1) {
            $request ->validate(
                [
                    'publisher' => 'required',
                ],
                [
                    'publisher.required' => 'Chưa chọn nhà xuất bản',
                ]
            );

            $publisher = $request->input('publisher');
        }

        else {
            $request ->validate(
                [
                    'otherPublisher' => 'required|string',
                ],
                [
                    'otherPublisher.required' => 'Chưa nhập nhà xuất bản',
                    'otherPublisher.string' => 'Tên nhà xuất bản sai định dạng',
                ]
                );

            $newPublisher = Publisher::create([
                'nha_xuat_ban' => $request->input('otherPublisher')
            ]);

            $publisher = $newPublisher->id;
        }


        // Kiểm tra nhà cung cấp bản quyền
        if($request->input('chosenProvider') == 1) {
            $request ->validate(
                [
                    'provider' => 'required',
                ],
                [
                    'provider.required' => 'Chưa chọn đơn vị cung cấp bản quyền',
                ]
            );

            $provider = $request->input('provider');
        }

        else {
            $request ->validate(
                [
                    'otherProvider' => 'required|string',
                ],
                [
                    'otherProvider.required' => 'Chưa nhập nhà xuất bản',
                    'otherProvider.string' => 'Tên nhà xuất bản sai định dạng',
                ]
                );

            $newProvider = Publisher::create([
                'ten_nha_cung_cap' => $request->input('otherProvider')
            ]);

            $provider = $newProvider->id;
        }

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

        try {
            $work = Work::create(
                [
                    'tua_de' => $request->input('titleWork'),
                    'tac_gia' => $request->input('author'),
                    'dich_gia' => $request->input('translator'),
                    'ngon_ngu' => $request->input('language'),
                    'nam_xuat_ban'  => $request->input('publishYear'),
                    'nha_xuat_ban'=> $publisher,
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
                    'ban_quyen' => $provider,
                    'trang_thai' => 3,
                ]
            );
        } catch (\Exception $e) {
            abort(401);
        }

        foreach($request->input('categoryCheck', []) as $category) {
            if($category == -1) {
                
                // Tách nếu có nhiều thể loại được thêm (,)
                $arrCtg = explode(',', $request->input('otherCategories'));
                
                foreach($arrCtg as $ctg) {

                    if(!empty(trim($ctg))) {
                        // Tạo thể loại mới
                        $newCategory = Category::create([

                            // Chuyển chuỗi về kiểu viết thường, sau đó viết hoa chữ cái đầu và xóa khoảng trắng hai đầu chuỗi
                            'ten_the_loai' => trim(ucfirst(strtolower($ctg))), 
                        ]);

                        $category = $newCategory->id;

                        // Thêm thể loại cho tác phẩm
                        WorksCategories::create([
                            'tac_pham' => $work->id,
                            'the_loai' => $category,
                        ]);
                    }
                }
            }

            else {
                WorksCategories::create([
                    'tac_pham' => $work->id,
                    'the_loai' => $category,
                ]);
            }
        }

        return redirect()->route('work.details', ['id' => $work->id])->with('success-upload', 'Đăng tải thành công, chờ phê duyệt.');
    }

    /**
     * Giao diện chỉnh sửa tác phẩm
     * route('work.edit')
     */
    public function edit(string $id)
    {
        // lấy danh sách nhà cung cấp bản quyền, thể loại, trạng thái
        $copyrights = CopyrightProvider::All();
        // $statuses = WorkStatus::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        
        // lấy đường dẫn tới thư mục chứa ảnh bìa
        $coverStoragePath = Storage::url('covers');

        // lấy thông tin tác phẩm
        $work = Work::find($id);
        $workCate = WorksCategories::where('tac_pham', $id)->pluck('the_loai')->toArray();
        $account = Account::find($work->tai_khoan_dang_tai);
        $status = WorkStatus::find($work->trang_thai);
        $copyright = CopyrightProvider::find($work->ban_quyen);
        $publisher = Publisher::find($work->nha_xuat_ban);

        return view('work_management_views.edit', compact('publishers', 'publisher', 'work', 'coverStoragePath', 'categories', 'copyright', 'account', 'copyrights', 'status', 'workCate'));
    }

    /**
     * Cập nhật thông tin tác phẩm
     * route('work.update')
     */ 
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'fileCover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'titleWork' => 'required|string',
                'translator' => 'nullable|string',
                'author' => 'required|string',
                'language' => 'required|string',
                // kiểm tra năm xuất bản phải nhỏ hơn hoặc bằng năm hiện tại
                'publishYear' => 'required|integer|lte:'. date('Y'),
                'dirEditor' => 'required|string',
                'editor' => 'required|string',
                'chosenPublisher' => 'required',
                'chosenProvider' => 'required',
                'dkxb' => 'required|string',
                'isbn'=> 'required|string',
                'qdxb' => 'required|string',
                'qdxbDate' => 'required|before: now',
                // kiểm tra mảng categoryCheck có ít nhất 1 phần tử (có ít nhất 1 thể loại được chọn)
                'categoryCheck' => 'required|array|min:1',
                // 'categoryCheck.*' => 'accepted',
                // 'statusWork' => 'required',
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
                'chosenPublisher.required' => 'Chưa chọn nhà xuất bản',
                'chosenProvider.required' => 'Chưa chọn nhà cung cấp bản quyền',
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
                // 'statusWork.required' => 'Chưa chọn trạng thái',
                'fileWork.file' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.mimes' => 'Không phải tệp tin văn bản (.doc, .docx, .txt, .pdf)',
                'fileWork.max' => 'Kích thước tệp tác phẩm quá lớn',
                'summary.required' => 'Chưa nhập mô tả nội dung tác phẩm',
                'summary.string' => 'Mô tả nội dung sai định dạng',
            ]
        );


        // Kiểm tra thể loại
        foreach($request->input('categoryCheck', []) as $category) {
            if($category == -1) {
               $request->validate(
                    [
                        'otherCategories' => 'required|regex:/^[\p{L},\s]+$/u',
                    ],
                    [
                        'otherCategories.required' => 'Chưa nhập thể loại mới',
                        'otherCategories.regex' => 'Tên (các) thể loại sai định dạng',
                    ]
                );
            }
        }

        // Kiểm tra nhà xuất bản
        if($request->input('chosenPublisher') == 1) {
            $request ->validate(
                [
                    'publisher' => 'required',
                ],
                [
                    'publisher.required' => 'Chưa chọn nhà xuất bản',
                ]
            );

            $publisher = $request->input('publisher');
        }

        else {
            $request ->validate(
                [
                    'otherPublisher' => 'required|string',
                ],
                [
                    'otherPublisher.required' => 'Chưa nhập nhà xuất bản',
                    'otherPublisher.string' => 'Tên nhà xuất bản sai định dạng',
                ]
                );

            $newPublisher = Publisher::create([
                'nha_xuat_ban' => $request->input('otherPublisher')
            ]);

            $publisher = $newPublisher->id;
        }


        // Kiểm tra nhà cung cấp bản quyền
        if($request->input('chosenProvider') == 1) {
            $request ->validate(
                [
                    'provider' => 'required',
                ],
                [
                    'provider.required' => 'Chưa chọn đơn vị cung cấp bản quyền',
                ]
            );

            $provider = $request->input('provider');
        }

        else {
            $request ->validate(
                [
                    'otherProvider' => 'required|string',
                ],
                [
                    'otherProvider.required' => 'Chưa nhập nhà xuất bản',
                    'otherProvider.string' => 'Tên nhà xuất bản sai định dạng',
                ]
                );

            $newProvider = Publisher::create([
                'ten_nha_cung_cap' => $request->input('otherProvider')
            ]);

            $provider = $newProvider->id;
        }


        if($request->file('fileCover')) {

            // Xóa ảnh bìa cũ khỏi server
            Storage::delete(Storage::path('covers/' . Work::where('id', $id)->value('anh_bia')));

            $fileCover = $request['fileCover'];
            
            // lấy tên file
            $fileNameCover = str_replace(' ', '', $fileCover->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileCover->storeAs('public/covers', $fileNameCover);

            Work::where('id', $id)->update(['anh_bia' => $fileNameCover]);
        }

        if($request->file('fileWork')) {

            // Xóa tệp sách cũ khỏi server
            Storage::delete(Storage::path('works/' . Work::where('id', $id)->value('tep_tin')));

            $fileWork = $request['fileWork'];
            
            // lấy tên file
            $fileNameWork = str_replace(' ', '', $fileWork->getClientOriginalName());
            
            // upload tệp tin với tên đã xóa khoảng trắng (tránh lỗi)
            $path = $fileWork->storeAs('public/works', $fileNameWork);

            Work::where('id', $id)->update(['anh_bia' => $fileNameWork]);
        }

        Work::where('id', $id)->update([
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

            // Tác phẩm khi được biên tập viên đăng tải hoặc chỉnh sửa phải được phê duyệt trước khi đăng tải chính thức
            'trang_thai' => 3,

            'ban_quyen' => $request->input('provider'),
        ]);

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
                        ->join('work_statuses as s', 'works.trang_thai', '=', 's.id')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan', 's.ten_trang_thai_tp', 'p.gia_ban_thuong', 'p.gia_ban_db', 't.thoi_diem')
                        ->orderByDesc('id')
                        ->get();

        return view('work_management_views.prices', compact('works'));
    }

    public function getHiddenWorkAdmin()
    {
        $works = Work::leftJoin('prices as p', 'p.tac_pham', '=', 'works.id')
                        ->leftJoin('times as t', 'p.thoi_diem', '=', 't.id')
                        ->leftJoin('accounts as a', 'works.tai_khoan_dang_tai', '=', 'a.id')
                        ->where('works.trang_thai', '2')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan',  'p.gia_ban_thuong', 'p.gia_ban_db', 't.thoi_diem')
                        ->orderByDesc('id')
                        ->get();

        return view('work_management_views.prices', compact('works'));
    }

    public function getApproveWorkAdmin()
    {
       $works = Work::leftJoin('prices as p', 'p.tac_pham', '=', 'works.id')
                        ->leftJoin('times as t', 'p.thoi_diem', '=', 't.id')
                        ->leftJoin('accounts as a', 'works.tai_khoan_dang_tai', '=', 'a.id')
                        ->where('works.trang_thai', '3')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan', 'p.gia_ban_thuong', 'p.gia_ban_db', 't.thoi_diem')
                        ->orderByDesc('id')
                        ->get();

        return view('work_management_views.approve', compact('works'));
    }

    public function getPublicWorkAdmin()
    {
        $works = Work::leftJoin('prices as p', 'p.tac_pham', '=', 'works.id')
                        ->leftJoin('times as t', 'p.thoi_diem', '=', 't.id')
                        ->leftJoin('accounts as a', 'works.tai_khoan_dang_tai', '=', 'a.id')
                        ->where('works.trang_thai', '=', '1')
                        ->select('works.id', 'works.tua_de', 'a.ten_tai_khoan', 'p.gia_ban_thuong', 'p.gia_ban_db', 't.thoi_diem')
                        ->orderByDesc('id')
                        ->get();

        return view('work_management_views.prices', compact('works'));
    }

    public function getDetailsApproveWork($id)
    {
        $coverStoragePath = Storage::url('covers');

        $work = Work::find($id);

        $prices = Price::join('times', 'times.id', '=', 'prices.thoi_diem')
                        ->where('times.thoi_diem', '<=', now())
                        ->where('prices.id', $id)
                        ->groupBy('prices.id')
                        ->orderBy('times.thoi_diem', 'desc')
                        ->limit(1)
                        ->first();

        $workCate = WorksCategories::where('tac_pham', $id)->get();
        $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

        $account = Account::find($work->tai_khoan_dang_tai);

        $copyright = CopyrightProvider::find($work->ban_quyen);

        $publisher = Publisher::find($work->nha_xuat_ban);

        return view('work_management_views.approve-details', compact('prices', 'publisher', 'work', 'coverStoragePath', 'categories', 'copyright', 'account'));
    }
}
