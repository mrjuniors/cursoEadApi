<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Requests\StoreSupport;
use App\Http\Resources\Api\ReplySupportResource;
use App\Http\Resources\Api\SupportResource;
use App\Repositories\Api\SuporteRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;
    
    public function __construct(SuporteRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    } 

    public function index(Request $request)
    {        
        $supports = $this->repository->getSupports($request->all());
        return SupportResource::collection($supports);
    }

    public function store(StoreSupport  $request)
    {       
        $support = $this->repository->createNewSupport($request->validated());
        return new SupportResource($support);
    }

    public function createReply(StoreReplySupport $request,$supportId)
    {        
        $reply = $this->repository->createReplyToSupportId($supportId,$request->all());
        return new ReplySupportResource($reply);
    }

}
