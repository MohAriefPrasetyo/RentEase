<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $guarded = [];

    public function rental()
{
    return $this->belongsTo(Rental::class);
}
}
