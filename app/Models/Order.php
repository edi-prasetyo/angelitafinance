<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // public function total_price()
    // {
    //     return $this->hasMany(OrderItem::class, 'order_id', 'id');
    // }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
        // return $this->belongsTo(Payment::class, 'order_id', 'id');

    }
    public function orderCount()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function appOrder()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function appOrderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
