<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'amount',
    ];

    protected $guarded = [
        'id',
        'user_id',
        'bank_id',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
