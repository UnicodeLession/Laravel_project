<?php

namespace Modules\Course\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Modules\Category\src\Repositories\CategoryRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Course\src\Repositories\CourseRepository;

class CourseController extends Controller
{
    protected $courseRepo;
    protected $categoryRepo;
    protected $teacherRepo;

    public function __construct
    (
        CourseRepository $courseRepo,
        CategoryRepository $categoryRepo,
        TeacherRepository $teacherRepo
    )
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo =$categoryRepo;
        $this->teacherRepo = $teacherRepo;
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
    public function getCategories($courseData){
        $categories =[];
        foreach ($courseData['categories'] as $category) {
            $categories[$category] = [
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }
        return $categories;
    }

    public function create()
    {
        $pageTitle = 'Thêm Khóa Học';
        $categories = $this->categoryRepo->getAllCategories();
        $teachers = $this->teacherRepo->getAllTeachers()->get();
        return view('course::add', compact('teachers','pageTitle', 'categories'));
    }

    public function store(CourseRequest $request)
    {
        $courseData = $request->except(['_token']);
        if (!$courseData['sale_price']) {
            $courseData['sale_price'] = 0;
        }

        if (!$courseData['price']) {
            $courseData['price'] = 0;
        }
        $course = $this->courseRepo->create($courseData);

        $categories = $this->getCategories($courseData);

        $this->courseRepo->createCourseCategories($course, $categories);
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
        $categoryIds = $this->courseRepo->getRelatedCategories($course);
        $categories = $this->categoryRepo->getAllCategories();
        if (!$course) {
            abort(404);
        }
        $pageTitle = 'Cập nhật khóa học';
        return view('course::edit', compact('categoryIds','course', 'pageTitle', 'categories'));
    }

    public function update(CourseRequest $request, $id)
    {
        $courseData = $request->except(['_token', '_method']);
        if (!$courseData['sale_price']) {
            $courseData['sale_price'] = 0;
        }
        if (!$courseData['price']) {
            $courseData['price'] = 0;
        }
        $this->courseRepo->update($id, $courseData); // update sẽ trả về bool
        $course = $this->courseRepo->find($id);
        $categories = $this->getCategories($courseData);
        $this->courseRepo->updateCourseCategories($course, $categories);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Cập Nhật', 'attribute' => 'Khóa Học']))
            ->with('type', 'success');
    }

    public function delete($id)
    {
        $course = $this->courseRepo->find($id);
        $this->courseRepo->deleteCourseCategories($course);
        $status = $this->courseRepo->delete($id);
        if ($status){
            deleteImageStorage($course->thumbnail);
        }
        return back()->with('msg', __('messages.success',
            ['action' => 'Xóa', 'attribute' => 'Khóa Học']))
            ->with('type', 'success');
    }
}
