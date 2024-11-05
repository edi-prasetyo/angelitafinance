<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function order()
    {
        $driver_id = Auth::user()->id;
        $orderDriver = OrderItem::where('driver_id', $driver_id)->where('stage', 1)->get();
        if ($orderDriver) {
            return response()->json([
                'success' => true,
                'data' => $orderDriver
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
