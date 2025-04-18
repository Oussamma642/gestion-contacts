<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'category' => 'ami',
        ];
    }
}