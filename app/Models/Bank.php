<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'account_number',
    ];

    protected $guarded = [
        'id'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'bank_id');
    }
}
