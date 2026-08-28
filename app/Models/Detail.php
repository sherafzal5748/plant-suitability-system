<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

}
