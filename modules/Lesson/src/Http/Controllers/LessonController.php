<?php

namespace Modules\Lesson\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Lesson\src\Models\Lesson;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;
use Modules\Lesson\src\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    protected $lessonRepo;

    public function __construct(LessonRepositoryInterface $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }

    public function index()
    {
        $pageTitle = 'Danh Sách Bài Học';
        return view('lesson::lists', compact('pageTitle'));
    }
    public function data(){
        $lessons= $this->lessonRepo->getAllLessons()->get();
        dd($lessons);
    }
    public function create()
    {
        $pageTitle = 'Thêm Bài Học';
        return view('lesson::add', compact('pageTitle'));
    }

    public function store(LessonRequest $request)
    {
        $lesson = $request->except(['_token']);

        $this->lessonRepo->create($lesson);

        return redirect()->route('admin.lessons.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'Bài Học'
                    ]
                )
            )
            ->with('type', 'success');
    }
}
