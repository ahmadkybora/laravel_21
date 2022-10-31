<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titles = [];
        $brands = Brand::all()->toArray();
        $categories = Category::pluck('title')->toArray();
        $key = array_rand($brands);
        $titles = array_merge($titles, $categories);
    
        return [
            'brand_id' => $brands[$key]['id'],
            'title' => maker($titles),
            'commentable_type' => rand(0, 1) == 1 ? 'App\Models\Product' : 'App\Models\Article',
            'commentable_id' => rand(1, 20),
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
