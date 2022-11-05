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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphToMany(User::class, 'comments', 'comments')
            ->withPivot('description', 'state')
            ->withTimestamps();
    }

    public function viewers()
    {
        return $this->morphToMany(User::class, 'viewers', 'viewers')
            ->withPivot('ip')
            ->withTimestamps();
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likes', 'likes')
            ->withPivot('state')
            ->withTimestamps();
    }

    public function favorites()
    {
        return $this->morphToMany(User::class, 'favorites')
            ->withTimestamps();
    }

}
