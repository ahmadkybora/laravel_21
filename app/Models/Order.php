<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'state',
        'products',
    ];

    protected $guarded = [
        'id',
        'user_id',
        'transaction_id',
    ];

    protected $casts = [
        'stated_at' => 'datetime:M/d/Y H:i:s',
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function transaction()
    {
        return $this->belongsTo('App\UserTransaction', 'transaction_id');
    }

}
