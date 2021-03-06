<?php

namespace App\Repositories\Api;

use App\Models\Course;

//use Your Model

/**
 * Class CourseRepository.
 */
class CourseRepository
{
    protected $entity;
    
    public function __construct(Course $model)
    {
        $this->entity = $model;
    } 

    public function getAllCourses()
    {
        return $this->entity->with('modules.lessons.views')->get();
    }

    public function getCourse(string $identify)
    {
        return $this->entity->with('modules.lessons')->findOrFail($identify);
    }
}
