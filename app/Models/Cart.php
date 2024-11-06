<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PickupPoint;

class Cart extends Model
{
    use HasFactory;
    public function pickupPoint(){
        return $this->belongsTo(PickupPoint::class, 'location_id');
    }
}
