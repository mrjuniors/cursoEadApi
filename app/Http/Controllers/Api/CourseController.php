<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::get();

        return CourseResource::collection($courses);
    }

    public function show($id) {
        $courses = Course::findOrFail($id);

        return new CourseResource($courses);
    }
}
