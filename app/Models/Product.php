<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'price',
        'description',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // public function viewers()
    // {
    //     return $this->morphToMany('App\User', 'viewers', 'viewers')
    //         ->withPivot('ip')
    //         ->withTimestamps();
    // }

    // public function likes()
    // {
    //     return $this->morphToMany('App\User', 'likes', 'likes')
    //         ->withPivot('state')
    //         ->withTimestamps();
    // }

    // public function favorites()
    // {
    //     return $this->morphToMany('App\User', 'favorites')
    //         ->withTimestamps();
    // }
}
