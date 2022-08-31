<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = \App\Models\Department::class;


    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
