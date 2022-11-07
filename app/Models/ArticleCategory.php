<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    protected $guarded = [
        'id',
        'user_id',
    ];
    
    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
