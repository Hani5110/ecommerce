<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'email',
        'payment_method',
        'total_amount',
         'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
