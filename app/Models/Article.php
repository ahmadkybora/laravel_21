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
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
