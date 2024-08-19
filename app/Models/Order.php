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

    public function payments()
    {
        return $this->hasMany(Payment::class);
        // return $this->belongsTo(Payment::class, 'order_id', 'id');

    }
    public function orderCount()
    {
        return $this->hasMany(OrderItem::class);
    }
}
