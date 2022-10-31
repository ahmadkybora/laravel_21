<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $names = [];
        $users = User::pluck('secret_key')->toArray();
        $names = array_merge($names, $users);
    
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => time() . $this->faker->unique()->safeEmail,
            'username' => Str::of($this->faker->userName)->replace('.', '')->kebab() . time(),
            'email_verified_at' => now(),
            'mobile' => '09' . $this->faker->numberBetween(100000000, 999999999),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'state' => 1,
            'secret_key' => Str::kebab(makeWord($names)),    
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
            ];
        });
    }
}

if (!function_exists('makeWord'))
{
    function makeWord(&$names)
    {
        do
        {
            $faker = \Faker\Factory::create();
            $name = $faker->unique()->words(3, true);
        } while (in_array($name, $names));
        $names[] = $name;
        return $name;
    }
}