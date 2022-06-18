<?php

namespace App\Repositories\Api;

use App\Models\Support;
use App\Models\User;

//use Your Model

/**
 * Class SuporteRepository.
 */
class SuporteRepository
{
    protected $entity;
    
    public function __construct(Support $support)
    {
        $this->entity = $support;
    } 
    

    public function getSupports(array $filters = [])
    {
       
        return $this->getUserAuth()
            ->supports()
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }
            })
            ->get();                   
    }

  

    private function getUserAuth() : User
    {
        //return auth()->user();
        return User::first();

    }
}
