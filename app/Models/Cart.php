<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty'
    ];

    protected $guarded = [
        'id',
        'product_id',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', "user_id");
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', "product_id");
    }
}
