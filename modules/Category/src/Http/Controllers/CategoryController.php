<?php

namespace Modules\Category\src\Http\Controllers;

use Modules\Category\src\Repositories\CategoryRepository;
use Modules\Category\src\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class CategoryController extends Controller{

    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index(){
        $pageTitle = 'Danh Sách Danh Mục';
        return view('category::lists', compact('pageTitle'));
    }
    public function data(){
        $categories = $this->categoryRepo->getCategories();
        return DataTables::of($categories)
            ->editColumn(
                'created_at', function($category){
                    return Carbon::parse($category->created_at)->format('H:i:s  d/m/Y');
                })
            ->editColumn(
                'link', function($category){
                return '<a href="#" class="btn btn-primary btn-sm">Xem</a>';
            })
            ->addColumn('edit', function ($category){
                return '<a href="'.route('admin.categories.edit', $category->id).'" class="btn btn-warning btn-sm">Sửa</a>';
            })
            ->addColumn('delete', function ($category){
                return '<a href="'.route('admin.categories.delete', $category->id).'" class="btn btn-danger btn-sm post-delete-action">Xóa</a>';
                // post-delete-action: delete với phương thức post
            })
            ->rawColumns(['edit', 'delete', 'link'])
            ->toJson();
    }
    public function create(){
        $pageTitle = "Thêm Danh Mục";
        $categories = $this->categoryRepo->getAllCategories();
        return view('category::add', compact('pageTitle','categories'));
    }
    public function store(CategoryRequest $request){
        $this->categoryRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('admin.categories.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'Danh Mục'
                    ]
                )
            )
            ->with('type', 'success');
    }
    public function edit($id){
        $category = $this->categoryRepo->find($id);
        $categories = $this->categoryRepo->getAllCategories();
        if(!$category) {
            abort(404);
        }
        $pageTitle = "Cập Nhật Danh Mục";
        return view('category::edit', compact('pageTitle','categories','category'));
    }
    public function update($id, CategoryRequest $request){
        $data = $request->except('_token');
;        $this->categoryRepo->update($id, $data);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Cập Nhật', 'attribute' => 'Danh Mục']))
            ->with('type', 'success');
    }
    public function delete($id){
        $this->categoryRepo->delete($id);
        return back()->with('msg', __('messages.success',
            ['action' => 'Xóa', 'attribute' => 'Danh Mục']))
            ->with('type', 'success');
    }
}
