<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'priority',
        'status',
    ];

    protected $guarded = [
        'id',
        'user_id',
        'closer_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
        'seen_at' => 'datetime:M/d/Y H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function closer()
    {
        return $this->belongsTo(User::class, 'closer_id');
    }

    public function details()
    {
        return $this->hasMany(TicketDetail::class, 'ticket_id');
    }

}
