<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }
}
