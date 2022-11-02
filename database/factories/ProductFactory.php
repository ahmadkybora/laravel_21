<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titles = [];
        $categories = ProductCategory::all()->toArray();
        $products = Product::pluck('title')->toArray();
        $key = array_rand($categories);
        $titles = array_merge($titles, $products);
    
        $path = ('public/images/products');
        if(!\Illuminate\Support\Facades\Storage::exists($path)){
            \Illuminate\Support\Facades\Storage::makeDirectory($path);
        }
    
        $image = storage_path('app/public/images/products');


        $dir = $image;
        $width = 800;
        $height = 600;
        $category = 'sports';
        $fullpath = true;
        $randomize = true;
        $word = 'man-ahmad-montazeri-hastam';
    
        $image = $this->faker->image($dir, $width, $height, $category,$fullpath, $randomize, $word);
    
        return [
            'category_id' => $categories[$key]['id'],
            'title' => maker($titles),
            'price' => $this->faker->numberBetween(1500, 6000),
            'description' => $this->faker->sentence,
            'image' => $image,
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
