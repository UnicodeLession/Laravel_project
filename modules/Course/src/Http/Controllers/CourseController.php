<?php

namespace Modules\Course\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Course\src\Repositories\CourseRepository;

class CourseController extends Controller
{
    protected $courseRepo;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }
    public function index()
    {
        $pageTitle = 'Quản Lý Khóa Học';

        return view('course::lists', compact('pageTitle'));
    }

    public function data()
    {
        $courses = $this->courseRepo->getAllCourses();

        $data =  DataTables::of($courses)
            ->addColumn('edit', function ($course) {
                return '<a href="'.route('admin.courses.edit', $course).'" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($course) {
                return '<a href="'.route('admin.courses.delete', $course).'" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('status', function ($course) {
                return $course->status == 1 ? '<button class="btn btn-success">Ra mắt</button>' : '<button class="btn btn-warning">Chưa ra mắt</button>';
            })
            ->editColumn('price', function ($course) {
                if ($course->price) {
                    if ($course->sale_price) {
                        $price = number_format($course->sale_price).',000 VND';
                    } else {
                        $price = number_format($course->price).',000 VND';
                    }
                } else {
                    $price = 'Miễn phí';
                }

                return $price;
            })
            ->rawColumns(['edit', 'delete', 'status'])
            ->toJson();
        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm Khóa Học';
        return view('course::add', compact('pageTitle'));
    }

    public function store(CourseRequest $request)
    {
        $courses = $request->except(['_token']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->courseRepo->create($courses);

        return redirect()->route('admin.courses.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'Khóa Học'
                    ]
                )
            )
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $course = $this->courseRepo->find($id);
        if (!$course) {
            abort(404);
        }
        $pageTitle = 'Cập nhật khóa học';
        return view('course::edit', compact('course', 'pageTitle'));
    }

    public function update(CourseRequest $request, $id)
    {
        $courses = $request->except(['_token', '_method']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->courseRepo->update($id, $courses);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Cập Nhật', 'attribute' => 'Khóa Học']))
            ->with('type', 'success');
    }

    public function delete($id)
    {
        $this->courseRepo->delete($id);
        return back()->with('msg', __('messages.success',
            ['action' => 'Xóa', 'attribute' => 'Khóa Học']))
            ->with('type', 'success');
    }
}
