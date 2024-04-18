<?php

namespace App\Http\Controllers;

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

class WorkListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            'select w.*, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem)
            FROM prices p
            JOIN works w ON w.id = p.tac_pham
            JOIN times t ON t.id = p.thoi_diem
            where t.thoi_diem <= Now()
            GROUP BY w.id) b join works w on b.id = w.id;'
       );
        

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
            'select w.*, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem)
            FROM prices p
            JOIN works w ON w.id = p.tac_pham
            JOIN times t ON t.id = p.thoi_diem
            where t.thoi_diem <= Now()
            GROUP BY w.id) b join works w on b.id = w.id;'
       );
        
        // lấy danh sách tác phẩm nổi bật
        // $workNom = WorksNominations::where('de_cu', '1')->get();
        // $hotWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();

        $hotWorks = DB::select(
            'select w.*, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem) as thoi_diem
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= Now()
                GROUP BY w.id) b join works w on b.id = w.id
                                join works_nominations n on b.id = n.id
            where n.de_cu = 1
            limit 8;');


        // lấy danh sách tác phẩm được biên tập viên đề cử
        // $workNom = WorksNominations::where('de_cu', '2')->get();
        // $nomWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();
        
        $nomWorks = DB::select(
            'select w.*, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem) as thoi_diem
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= Now()
                GROUP BY w.id) b join works w on b.id = w.id
                                join works_nominations n on b.id = n.id
            where n.de_cu = 2;');

        // lấy danh sách tác phẩm đã đạt giải
        // $workNom = WorksNominations::where('de_cu', '3')->get();
        // $awWorks = Work::whereIn('id', $workNom->pluck('tac_pham'))->get();
        
        $awWorks = DB::select(
            'select w.*, b.gia_thanh
            from (SELECT w.id, p.gia_thanh, max(t.thoi_diem) as thoi_diem
                FROM prices p
                JOIN works w ON w.id = p.tac_pham
                JOIN times t ON t.id = p.thoi_diem
                where t.thoi_diem <= Now()
                GROUP BY w.id) b join works w on b.id = w.id
                                join works_nominations n on b.id = n.id
            where n.de_cu = 3;');

        $coverStoragePath = Storage::url('covers');

        return view('home', compact('hotWorks', 'nomWorks', 'awWorks', 'coverStoragePath', 'nominations', 'works'));
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
