<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 months');

        return [
//            'name' => $this->faker->name,
            'username' => Str::random(6),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'activation_code' => Str::random(15),
            'balance' => rand(1,5000),
            'xf_user_id' => $this->faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
            'group_id' => Group::all('id')->random(),
            'ban_reason' => $this->faker->sentence(rand(3, 8), true),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }


}
