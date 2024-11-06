<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// MODELS
use App\Models\{
    PhRegion,
    PhProvince,
    PhCity,
    PhBarangay
};

class DeliveryAddress extends Model
{
    protected $guarded = [];
    //
    public function region() {
        return $this->belongsTo(PhRegion::class,'region_code','regCode');
    }
    public function province() {
        return $this->belongsTo(PhProvince::class,'province_code','provCode');
    }
    public function city() {
        return $this->belongsTo(PhCity::class,'city_code','citymunCode');
    }
    public function barangay() {
        return $this->belongsTo(PhBarangay::class,'brgy_code','brgyCode');
    }
}
