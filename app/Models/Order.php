<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderEditDetails()
    {
        return $this->hasMany(OrderEditDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function refund_requests()
    {
        return $this->hasMany(RefundRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickup_point()
    {
        return $this->belongsTo(PickupPoint::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }
}
