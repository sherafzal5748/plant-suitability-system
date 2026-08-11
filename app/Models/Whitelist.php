<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
