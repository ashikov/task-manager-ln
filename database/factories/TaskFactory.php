<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    TaskStatus,
    User
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $statusId = TaskStatus::inRandomOrder()->first()->id;
        $createdById = User::inRandomOrder()->first()->id;
        $assignedToId = User::inRandomOrder()->first()->id;
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'status_id' => $statusId,
            'created_by_id' => $createdById,
            'assigned_to_id' => $assignedToId
        ];
    }
}
