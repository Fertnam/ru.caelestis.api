<?php

namespace Database\Factories;

use App\Models\articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class cs_articlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all('id')->random(),
            'title' => $this->faker->title(),
            'content' => $this->faker->text(),
        ];
    }
}
