<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;

class ArticleFactory extends Factory
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
        $categories = ArticleCategory::all()->toArray();
        $articles = Article::pluck('title')->toArray();
        $key_users = array_rand($users);
        $key_categories = array_rand($categories);
        $titles = array_merge($titles, $articles);

        $path = ('public/images/articles');
        if(!\Illuminate\Support\Facades\Storage::exists($path)){
            \Illuminate\Support\Facades\Storage::makeDirectory($path);
        }
    
        $image = storage_path('app/public/images/articles');

        $dir = $image;
        $width = 800;
        $height = 600;
        $category = 'sports';
        $fullpath = true;
        $randomize = true;
        $word = 'man-ahmad-montazeri-hastam';
    
        $image = $this->faker->image($dir, $width, $height, $category,$fullpath, $randomize, $word);

        return [
            'user_id' => $users[$key_users]['id'],
            'category_id' => $categories[$key_categories]['id'],
            'title' => maker($titles),
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