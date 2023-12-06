<?php

namespace Modules\Course\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Course\src\Models\Course;
use Modules\Course\src\Repositories\CourseRepositoryInterface;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }


    public function getAllCourses()
    {
        return $this->model->select(['id', 'name', 'price', 'status', 'created_at']);
    }
    public function createCourseCategories($course, $data =[]){
        return $course->categories()->attach($data);
        /**
            $data =[
                 2=> ['created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
                 22=> ['created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ]
         * ở đây: 2 và 22 là category_id
         * timestamp bên trong
        */
    }
}
