<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvisoryTicket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'topic', 'message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(AdvisoryTicketReply::class)->orderBy('created_at');
    }

    public function latestReply()
    {
        return $this->hasOne(AdvisoryTicketReply::class)->latestOfMany();
    }
}
