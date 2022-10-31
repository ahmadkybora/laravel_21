<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titles = [];
        $users = User::all()->toArray();
        $categories = ArticleCategory::pluck('title')->toArray();
        $key = array_rand($users);
        $titles = array_merge($titles, $categories);
    
        return [
            'user_id' => $users[$key]['id'],
            'title' => maker($titles),
        ];
    }
}

if (!function_exists('maker'))
{
    function maker(&$titles)
    {
        do
        {
            $faker = \Faker\Factory::create();
            $title = $faker->unique()->words(3, true);
        } while (in_array($title, $titles));
        $titles[] = $title;
        return $title;
    }
}