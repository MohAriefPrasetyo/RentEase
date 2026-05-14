<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $guarded = [];
    
    public function category()
{
    return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
}

public function rentals()
{
    return $this->hasMany(Rental::class);
}
}
