<?php

namespace App\Repositories\Api;

use App\Models\Module;

//use Your Model

/**
 * Class ModuleRepository.
 */
class ModuleRepository
{
    protected $entity;
    
    public function __construct(Module $model)
    {
        $this->entity = $model;
    } 

    public function getModulesByCourseId(string $courseId)
    {
        return $this->entity
                    ->with('lessons.views')
                    ->where('course_id', $courseId)
                    ->get();
    }
}
