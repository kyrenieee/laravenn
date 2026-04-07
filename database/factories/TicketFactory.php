<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement(['open', 'in-progress', 'closed', 'on-hold']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'critical']),
            'assigned_to' => \App\Models\User::factory(),
            'due_date' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
        ];
    }
}
