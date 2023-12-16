<?php

namespace Modules\Lesson\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lesson\src\Models\Lesson;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public function getModel()
    {
        return Lesson::class;
    }
    public function getAllLessons()
    {
        return $this->model->select(['id', 'name', 'video_id', 'is_trial','views', 'position', 'duration', 'created_at']);
    }
}
