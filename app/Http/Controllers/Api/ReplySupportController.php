<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\Api\ReplySupportResource;
use App\Repositories\Api\ReplySupportRepository;

class ReplySupportController extends Controller
{
    
    protected $repository;
    
    public function __construct(ReplySupportRepository $replySupportRepository)
    {
        $this->repository = $replySupportRepository;
    } 

    public function createReply(StoreReplySupport $request,$supportId)
    {        
        $reply = $this->repository->createReplyToSupport($request->validated());
        return new ReplySupportResource($reply);
    }
}