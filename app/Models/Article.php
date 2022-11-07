<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    protected $guarded = [
        'id',
        'user_id',
        'category_id',
    ];
    
    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments()
    {
        return $this->morphToMany('App\Models\User', 'comments', 'comments')
            ->withPivot('description', 'state')
            ->withTimestamps();
    }

    public function viewers()
    {
        return $this->morphToMany('App\Models\User', 'viewers', 'viewers')
            ->withPivot('ip')
            ->withTimestamps();
    }

    public function likes()
    {
        return $this->morphToMany('App\Models\User', 'likes', 'likes')
            ->withPivot('state')
            ->withTimestamps();
    }

    public function favorites()
    {
        return $this->morphToMany('App\Models\User', 'favorites')
            ->withTimestamps();
    }

}
