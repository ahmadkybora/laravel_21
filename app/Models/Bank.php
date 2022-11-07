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

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
    ];
    
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'bank_id');
    }
}
