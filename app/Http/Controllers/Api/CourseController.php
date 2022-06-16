<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Repositories\Api\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    protected $repository;
    
    public function __construct(CourseRepository $courserepository)
    {
        $this->repository = $courserepository;
    } 

    public function index() {
        

        return CourseResource::collection($this->repository->getAllCourses());
    }

    public function show($id) {
       
        return new CourseResource($this->repository->getCourse($id));
    }
}
