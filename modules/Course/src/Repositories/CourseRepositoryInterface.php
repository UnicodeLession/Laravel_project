<?php

namespace Modules\Course\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CourseRepositoryInterface extends RepositoryInterface
{
    public function getAllCourses();
    public function createCourseCategories($course);
}
