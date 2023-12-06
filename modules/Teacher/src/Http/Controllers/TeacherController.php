<?php

namespace Modules\Teacher\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;

class TeacherController extends Controller
{
    protected $teacherRepo;

    public function __construct(TeacherRepository $teacherRepo)
    {
        $this->teacherRepo = $teacherRepo;
    }
    public function index()
    {
        $pageTitle = 'Danh Sách Giảng Viên';

        return view('teacher::lists', compact('pageTitle'));
    }

    public function data()
    {
        $teacher = $this->teacherRepo->getAllTeacher();

        $data =  DataTables::of($teacher)
            ->addColumn('edit', function ($teacher) {
                return '<a href="'.route('admin.teachers.edit', $teacher).'" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($teacher) {
                return '<a href="'.route('admin.teachers.delete', $teacher).'" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($teacher) {
                return Carbon::parse($teacher->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('image', function ($teacher) {

                return $teacher->image ? '<img src="'.$teacher->image.'" style="width: 80px;"/>' : '';
            })
            ->rawColumns(['edit', 'delete', 'image'])
            ->toJson();
        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm Giảng Viên';
        return view('teacher::add', compact('pageTitle'));
    }

    public function store(TeacherRequest $request)
    {
        $teacher = $request->except(['_token']);

        $this->teacherRepo->create($teacher);

        return redirect()->route('admin.teachers.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'Giảng Viên'
                    ]
                )
            )
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $teacher = $this->teacherRepo->find($id);

        if (!$teacher) {
            abort(404);
        }

        $pageTitle = 'Cập Nhật Giảng Viên';

        return view('teacher::edit', compact('teacher', 'pageTitle'));
    }

    public function update(TeacherRequest $request, $id)
    {
        $teacher = $request->except('_token');

        $this->teacherRepo->update($id, $teacher);

        return back()
            ->with('msg', __('messages.success', ['action' => 'Cập Nhật', 'attribute' => 'Giảng Viên']))
            ->with('type', 'success');
    }

    public function delete($id)
    {
        $this->teacherRepo->delete($id);
        return back()->with('msg', __('messages.success', ['action' => 'Xóa', 'attribute' => 'Giảng Viên']))
            ->with('type', 'success');
    }
}
