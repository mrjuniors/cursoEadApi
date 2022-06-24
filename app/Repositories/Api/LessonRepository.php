<?php

namespace App\Repositories\Api;

use App\Models\Lesson;
use App\Repositories\Api\Traits\RepositoryTrait;

//use Your Model

/**
 * Class LessonRepository.
 */
class LessonRepository
{
    use RepositoryTrait;

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

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();
        $view = $user->views()->where('lesson_id',$lessonId)->first();
        
        //CASO JA EXISTA UMA VIEW APENAS EFETUA O UPDATE
        if ($view) {
            return $view->update([
                'qty' => $view->qty + 1,
            ]);
        }

        //CASO NAO EXISTA UMA VIEW ELE CRIA UMA NOVA VIEW
        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}
