<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;
use App\Models\Brand;

class ProductCategoryFactory extends Factory
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
        $categories = ProductCategory::pluck('title')->toArray();
        $key = array_rand($brands);
        $titles = array_merge($titles, $categories);
    
        return [
            'brand_id' => $brands[$key]['id'],
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