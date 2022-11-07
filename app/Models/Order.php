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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }

}
