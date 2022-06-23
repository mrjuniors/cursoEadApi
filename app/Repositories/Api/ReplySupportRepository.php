<?php

namespace App\Repositories\Api;

use App\Models\ReplySupport;
use App\Repositories\Api\Traits\RepositoryTrait;

//use Your Model

/**
 * Class ReplySupportRepository.
 */
class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    public function createReplyToSupport(array $data)
    {
        $user = $this->getUserAuth();

        return $this->entity
                    ->create([
                        'support_id' => $data['support'],
                        'description' => $data['description'],
                        'user_id' => $user->id,
                    ]);
    }

}
