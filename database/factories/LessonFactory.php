<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        $name  = $this->faker->unique()->name();

        return [
            'module_id' => Module::factory(),
            'name'      => $name,
            'url'       => Str::slug($name),
            'video'     => Str::random(),
        ];
    }
}
