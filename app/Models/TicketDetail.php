<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'operator',
    ];

    protected $guarded = [
        'id',
        'from_id',
        'to_id',
        'parent_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
        'seen_at' => 'datetime:M/d/Y H:i:s',
    ];

}
