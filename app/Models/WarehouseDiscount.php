<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseDiscount extends Model
{
    //
    protected $table = 'warehouse_discounts';

    protected $guarded = [];

    public function warehouse() {
        return $this->belongsTo(PickupPoint::class);
    }
}
