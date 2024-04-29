<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetails;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;
use App\Models\WorksCategories;
use App\Models\CopyrightProvider;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Price;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Http\Request;

class WorkReadController extends Controller
{
    public function index($id)
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

        $publisher = Publisher::where('id', $work->nha_xuat_ban)->first();

        $workCate = WorksCategories::where('tac_pham', $id)->get();
        $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

        $copyright = CopyrightProvider::find($work->ban_quyen);

        return view('read_views.read_details', compact('prices', 'work', 'coverStoragePath', 'categories', 'copyright', 'publisher'));
    }

    public function getContent($id)
    {

        $work = Work::find($id);

        $prices = Price::join('times', 'times.id', '=', 'prices.thoi_diem')
                        ->where('times.thoi_diem', '<=', now())
                        ->where('prices.id', $id)
                        ->groupBy('prices.id')
                        ->orderBy('times.thoi_diem', 'desc')
                        ->limit(1)
                        ->first();

        $file = storage_path('app/public/works/') . $work->value('tep_tin');

        // Kiểm tra người dùng đã mua tác phẩm chưa
        if(
            BillDetails::join('bills', 'bills.id', '=', 'bill_details.hoa_don')
                        ->where('bills.tai_khoan', Session::get('user')->id)
                        ->where('bill_details.tac_pham', $id)->first()
        ) {
            $paid = True;
        }

        else {
            $paid = False;
        }

        // $file =  storage_path('app/public/works/test.txt');
        if (File::exists($file)) {

            // Tải file
            $phpWord = IOFactory::load($file);
            
            // Đếm số lượng đoạn
            $count = 0;

            // Lấy nội dung văn bản từ các phần
            $workContent = '';

            // Khởi tạo mảng dùng để phân trang nội dung
            $workContents = [];

            foreach ($phpWord->getSections() as $section) {
                
                foreach ($section->getElements() as $element) {
                    
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        
                        foreach ($element->getElements() as $textElement) {
                            
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $workContent .= $textElement->getText() . "\n";
                                $count += 1;

                                // Ngắt trang ở đoạn 30
                                if($count == 30) {
                                    $workContents[] = $workContent;
                                    $workContent = '';
                                    $count = 0;
                                }

                                // Nếu người dùng chưa mua tác phẩm, chỉ có phép đọc thử
                                if(!$paid && count($workContents) == 1) {
                                    break;
                                }
                            }
                        }

                        if(!$paid && count($workContents) == 1) {
                            break;
                        }

                    }

                    if(!$paid && count($workContents) == 1) {
                        break;
                    }
                }

                if(!$paid && count($workContents) == 1) {
                    break;
                }
            }

            $workContentPagination = new WorkListController();

            $workContents = $workContentPagination->paginate($workContents, 1);

            $workCate = WorksCategories::where('tac_pham', $id)->get();
            $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

            $coverStoragePath = Storage::url('covers');
            
            if($paid)
            {
                return view('read_views.read_content', compact('prices', 'workContents', 'work', 'coverStoragePath', 'categories'));
            }
            else {
                $notiPayment = 'Chưa thanh toán';
                return view('read_views.read_content', compact('prices', 'workContents', 'work', 'coverStoragePath', 'categories', 'notiPayment'));
            }

        } else {
            // return redirect()->route('read.details', ['id' => $id]);
            return response()->json(['error' => $file], 404);
        }
    }

    // Download tác phẩm
    public function download($id) {
        
        $work = Work::find($id);

        $bill = BillDetails::join('bills', 'bills.id', '=', 'bill_details.hoa_don')
                            ->where('bills.tai_khoan', Session::get('user')->id)
                            ->where('tac_pham', $id)->orderBy('phien_ban', 'desc')->first();
        
        if($bill && $bill->phien_ban == 2) {

            return response()->download(storage_path('app/public/works/') . $work->value('tep_tin'));

            return redirect()->back()->with('success-download', $work->tua_de);
        }

        $specialPrice = Price::join('times', 'times.id', '=', 'prices.thoi_diem')
                        ->where('times.thoi_diem', '<=', now())
                        ->where('prices.id', $work->id)
                        ->groupBy('prices.id')
                        ->orderBy('times.thoi_diem', 'desc')
                        ->select('gia_ban_db')->limit(1)->first();
        
        if($bill && $bill->phien_ban != 2) {
            $paid = BillDetails::join('bills', 'bills.id', '=', 'bill_details.hoa_don')
                        ->where('bills.tai_khoan', Session::get('user')->id)
                        ->where('bill_details.tac_pham', $work->id)
                        ->select('gia_thanh')->first();
            
            $price = $specialPrice->gia_ban_db - $paid->gia_thanh;
        }

        else {
            $price = $specialPrice->gia_ban_db;
        }

        return redirect()->back()->with(['warning-download' => $work->tua_de, 'work-download' => $work->id, 'price-download' => $price]);
    }
}
