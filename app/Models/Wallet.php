<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'credit',
        'cash',
        'state',
    ];

    protected $guarded = [
        'id',
        'owner_id',
        'state_modifier_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
        'state_modified_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
