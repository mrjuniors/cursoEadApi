<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreView;
use App\Http\Resources\Api\LessonResource;
use App\Repositories\Api\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;
    
    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    } 

    public function index($moduleId)
    {
        $lessons = $this->repository->getLessonsByModuleId($moduleId);
        return LessonResource::collection($lessons);
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLessons($id));
    }

    public function viewed(StoreView $request)
    {
        $this->repository->markLessonViewed($request->lesson);
        return response()->json(['success' => true]);
    }

    
}
