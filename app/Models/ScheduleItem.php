<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    use HasFactory;

    protected $table = ('schedule_item');

    protected $fillable = [
        'over_time',
        'fuel_amount',
        'parking_amount',
        'toll_amount'
    ];
}
