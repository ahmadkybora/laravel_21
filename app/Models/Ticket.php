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

    protected $casts = [
        'created_at' => 'datetime:M/d/Y H:i:s',
        'updated_at' => 'datetime:M/d/Y H:i:s',
        'seen_at' => 'datetime:M/d/Y H:i:s',
    ];

    protected $guarded = [
        'id',
        'user_id',
        'closer_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function closer()
    {
        return $this->belongsTo('App\Models\User', 'closer_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\TicketDetail', 'ticket_id');
    }

    public function unreed_tickets($profile)
    {
        return Ticket::where('user_id', $profile)->whereNull('seen_at')->count();
    }
}
