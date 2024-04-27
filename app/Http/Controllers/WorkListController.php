<?php

namespace App\Http\Controllers;

use App\Models\BillDetails;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;
use App\Models\WorksCategories;
use App\Models\Category;
use App\Models\Nomination;
use App\Models\WorksNominations;
use App\Models\Price;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class WorkListController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    public function paginate($works, $perPage) {

        // Số trang hiện tại, mặc định là 1
        $page = LengthAwarePaginator::resolveCurrentPage();

        // Tạo một Collection từ kết quả của truy vấn
        $collection = collect($works);

        // Phân trang dữ liệu
        $worksPaginated = $collection->slice(($page - 1) * $perPage, $perPage)->all();

        // Tạo một Paginator từ dữ liệu đã được phân trang
        $books = new LengthAwarePaginator($worksPaginated, count($collection), $perPage, $page);

        // Đặt URL cho các trang
        $books->setPath(request()->url());

        // Dữ liệu phân trang đã hoàn thành
        return $books;
    }


    public function index()
    {
        // lấy đường dẫn đến thư mục chứa ảnh bìa
        $coverStoragePath = Storage::url('covers');

        // lấy thông tin tác phẩm
        // $books = Work::all();

        // lấy thể loại
        $categories = Category::all();
        
        //lấy thời điểm gần nhất và không trễ hơn thời điểm hiện tại
        // $latestTime = Time::where('thoi_diem', '<=', Carbon::now())->first();

        $books = DB::select(
            'SELECT w.*, p.gia_ban_thuong, p.gia_ban_db
            FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                            JOIN works AS w ON w.id = p.tac_pham
            WHERE w.trang_thai = 1
                    AND (p.tac_pham, t.thoi_diem) IN (
                        SELECT p.tac_pham, MAX(t.thoi_diem)
                        FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                        WHERE t.thoi_diem <= NOW()
                        GROUP BY p.tac_pham)'
        );
        
        $books = $this->paginate($books, 6);

        return view('works_view.works_childe', compact('categories', 'books', 'coverStoragePath'));
        // $categories = Category::all();
        // return view('works')->with('categories', $categories);
    }

    public function handleFilter(Request $request)
    {
        if ($request->has('categoryCheck'))
        {
            $isChecked = $request->input('categoryCheck', []);

            if (!is_array($isChecked)) {
                $books_categories = WorksCategories::where('the_loai', $isChecked)->get();
            }
            else {
                $books_categories = WorksCategories::whereIn('the_loai', $isChecked)->get();
            }
              
            $books = Work::whereIn('id', $books_categories->pluck('tac_pham'))->get();

            if($books->isEmpty()) {
                $books = NULL;
                $coverStoragePath = NULL;
            }
            else {
                $coverStoragePath = Storage::url('covers');
            }
            
            $categories = Category::all();

            return view('works_view.works_childe_filter', compact('books', 'coverStoragePath', 'categories'));
        }
        
        else {
            $books = NULL;
            $categories = Category::all();
            $coverStoragePath = NULL;
        }
        return view('works_view.works_childe_filter', compact('books', 'coverStoragePath', 'categories'));
    }

    public function getNominations() {

        $nominations = Nomination::All();

        $works = DB::select(
            'SELECT w.*, p.gia_ban_thuong, p.gia_ban_db
            FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                            JOIN works AS w ON w.id = p.tac_pham
            WHERE w.trang_thai = 1
                    AND (p.tac_pham, t.thoi_diem) IN (
                        SELECT p.tac_pham, MAX(t.thoi_diem)
                        FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                        WHERE t.thoi_diem <= NOW()
                        GROUP BY p.tac_pham)
            ORDER BY w.id DESC
            LIMIT 10;'
       );
        
        // lấy danh sách tác phẩm nổi bật
        // $workNom = WorksNominations::where('de_cu', '1')->get();
        // $hotWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();

        $hotWorks = DB::select(
            'SELECT w.*, p.gia_ban_thuong, p.gia_ban_db
            FROM works AS w JOIN works_nominations AS n ON w.id = n.tac_pham
                            JOIN prices AS p ON w.id = p.tac_pham
                            JOIN times AS t ON t.id = p.thoi_diem                    
            WHERE n.de_cu = 1
                AND (p.tac_pham, t.thoi_diem) IN (
                        SELECT p.tac_pham, MAX(t.thoi_diem)
                        FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                        WHERE t.thoi_diem <= NOW()
                        GROUP BY p.tac_pham)'
        );


        // lấy danh sách tác phẩm được biên tập viên đề cử
        // $workNom = WorksNominations::where('de_cu', '2')->get();
        // $nomWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();
        
        $nomWorks = DB::select(
            'SELECT w.*, p.gia_ban_thuong, p.gia_ban_db
            FROM works AS w JOIN works_nominations AS n ON w.id = n.tac_pham
                            JOIN prices AS p ON w.id = p.tac_pham
                            JOIN times AS t ON t.id = p.thoi_diem                    
            WHERE n.de_cu = 2
                AND (p.tac_pham, t.thoi_diem) IN (
                        SELECT p.tac_pham, MAX(t.thoi_diem)
                        FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                        WHERE t.thoi_diem <= NOW()
                        GROUP BY p.tac_pham)'
        );

        // lấy danh sách tác phẩm đã đạt giải
        // $workNom = WorksNominations::where('de_cu', '3')->get();
        // $awWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();
        
        $awWorks = DB::select(
            'SELECT w.*, p.gia_ban_thuong, p.gia_ban_db
            FROM works AS w JOIN works_nominations AS n ON w.id = n.tac_pham
                            JOIN prices AS p ON w.id = p.tac_pham
                            JOIN times AS t ON t.id = p.thoi_diem                    
            WHERE n.de_cu = 3
                AND (p.tac_pham, t.thoi_diem) IN (
                        SELECT p.tac_pham, MAX(t.thoi_diem)
                        FROM times AS t JOIN prices AS p ON t.id = p.thoi_diem
                        WHERE t.thoi_diem <= NOW()
                        GROUP BY p.tac_pham)'
        );

        $coverStoragePath = Storage::url('covers');

        return view('home', compact('hotWorks', 'nomWorks', 'awWorks', 'coverStoragePath', 'nominations', 'works'));
    }

    /**
     * Lấy danh sách tác phẩm đã mua
     */
    public function getLibrary()
    {
        $categories = Category::all();

        $coverStoragePath = Storage::url('covers');
        // $bills = BillDetails::where('tai_khoan', session::get('user')->id)->get();
        $works = Work::join('bill_details', 'works.id', '=', 'bill_details.tac_pham')
                    ->join('bills', 'bills.id', '=', 'bill_details.hoa_don')
                    ->join('publishers', 'publishers.id', '=', 'works.nha_xuat_ban')
                    ->where('bills.tai_khoan', session::get('user')->id)
                    ->get();

        $works = $this->paginate($works, 2);

        return view('works_view.libary', compact('works', 'categories', 'coverStoragePath'));
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
