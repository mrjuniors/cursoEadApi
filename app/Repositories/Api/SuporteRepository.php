<?php

namespace App\Repositories\Api;

use App\Models\Support;
use App\Repositories\Api\Traits\RepositoryTrait;

//use Your Model

/**
 * Class SuporteRepository.
 */
class SuporteRepository
{
    use RepositoryTrait;
    
    protected $entity;
    
    public function __construct(Support $support)
    {
        $this->entity = $support;
    } 
    
    public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;

        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
       
        return $this->entity           
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

                if (isset($filters['user'])) {
                    $user = $this->getUserAuth();
                    $query->where('user_id', $user->id);
                }
            })
            ->with('replies')
            ->orderBy('updated_at')
            ->get();                   
    }

    public function createNewSupport(array $data): Support
    {
       $support =  $this->getUserAuth()
             ->supports()
             ->create([
                'lesson_id'   => $data['lesson'],
                'description' => $data['description'],
                'status'      => $data['status'],
             ]);

        return $support;
    }
  
    
    public function createReplyToSupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();
        $support = app(ReplySupportRepository::class)->getSupport($supportId);

        return $this
             ->entity
             ->create([
                'description'      => $data['description'],
                'user_id'          => $user->id,
             ]);
    }

    public function getSupport(string $id)
    {
        return $this->entity->findOrFail($id);
    }

}
