<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodList extends Model
{
    protected $table = 'payment_method_lists';

    protected $fillable = [
        'name',
        'value',
        'follow_up_instruction',
        'status'
    ];
}
