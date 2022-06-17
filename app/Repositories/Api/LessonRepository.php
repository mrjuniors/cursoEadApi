<?php

namespace App\Repositories\Api;

use App\Models\Api\Lesson;

//use Your Model

/**
 * Class LessonRepository.
 */
class LessonRepository
{
    protected $entity;
    
    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    } 

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->entity
                    ->where('module_id', $moduleId)
                    ->get();
    }

    public function getLessons(string $indentify)
    {
        return $this->entity->findOrFail($indentify);
    }
}
