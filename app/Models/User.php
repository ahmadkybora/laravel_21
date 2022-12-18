<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'password',
        'username',
        'postal_code',
        'home_address',
        'work_address',
        'state',
        'metadata',
        'avatar',
    ];

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function carts()
    {
        return $this->hasMany('App\Models\Cart', 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'user_id', 'id');
    }

    /**
     * شما میتوانید همه طرف روابط را در مدل های خود
     * بنویسید
     */
    // public function tickets()
    // {
    //     return $this->hasMany('App\Models\Ticket' , 'user_id', 'id');
    // }

    public function product_favorites()
    {
        return $this->morphedByMany('App\Models\Product', 'favorites');
    }

    public function article_favorites()
    {
        return $this->morphedByMany('App\Models\Article', 'favorites');
    }

    public function product_viewers()
    {
        return $this->morphedByMany('App\Models\Product', 'viewers');
    }

    public function article_viewers()
    {
        return $this->morphedByMany('App\Models\Article', 'viewers');
    }

    public function product_likes()
    {
        return $this->morphedByMany('App\Models\Product', 'likable', 'likes')
            ->withPivot('state')
            ->withTimestamps();
    }

    public function article_likes()
    {
        return $this->morphedByMany('App\Models\Article', 'likes', 'likes')
            ->withPivot('state')
            ->withTimestamps();
    }

    public function product_comments()
    {
        return $this->morphedByMany('App\Models\Product', 'comments', 'comments')
            ->withPivot('description', 'state')
            ->withTimestamps();
    }

    public function article_comments()
    {
        return $this->morphedByMany('App\Models\Article', 'comments', 'comments')
            ->withPivot('description', 'state')
            ->withTimestamps();
    }
    
}
