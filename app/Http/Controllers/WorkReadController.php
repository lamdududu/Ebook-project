<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;
use App\Models\WorksCategories;
use App\Models\CopyrightProvider;
use App\Models\Category;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Http\Request;

class WorkReadController extends Controller
{
    public function index($id)
    {
        $coverStoragePath = Storage::url('covers');

        $work = Work::find($id);

        $workCate = WorksCategories::where('tac_pham', $id)->get();
        $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

        $copyright = CopyrightProvider::find($work->ban_quyen);

        return view('read_views.read_details', compact('work', 'coverStoragePath', 'categories', 'copyright'));
    }

    public function getContent($id)
    {

        $work = Work::find($id);

        $file = storage_path('app/public/works/') . $work->value('tep_tin');

        // $file =  storage_path('app/public/works/test.txt');
        if (File::exists($file)) {
            // $phpWord = IOFactory::load($file);
            // $workContent = $phpWord->getSections()[0]->getElements();
            // $workContent = file_get_contents($file);
            // return view('read_views.read_content', compact('workContent', 'work'));
            $phpWord = IOFactory::load($file);

            // Lấy nội dung văn bản từ các phần
            $workContent = '';
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $workContent .= $textElement->getText() . "\n";
                            }
                        }
                    }
                }
            }

            $workCate = WorksCategories::where('tac_pham', $id)->get();
            $categories = Category::whereIn('id', $workCate->pluck('the_loai'))->get();

            $coverStoragePath = Storage::url('covers');
            
            return view('read_views.read_content', compact('workContent', 'work', 'coverStoragePath', 'categories'));

        } else {
            // return redirect()->route('read.details', ['id' => $id]);
            return response()->json(['error' => $file], 404);
        }
    }
}
