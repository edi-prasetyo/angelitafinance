<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function total_bill()
    {
        $amountSum = Order::selectRaw('sum(bill)')
            // ->whereColumn('order_id', 'orders.id')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])
            ->getQuery();

        $bills = Order::where('bill', '>', 0)
            ->selectSub($amountSum, 'amount_sum')
            ->orderBy('id', 'desc')
            ->with('orderCount')
            ->first();

        // $countbill = count($bills->orderCount);

        if ($bills) {
            return response()->json([
                'success' => true,
                'data' => $bills
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function total_paid()
    {
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])

            ->getQuery();


        $bills = Order::where('bill', '<=', 0)
            // ->selectSub($amountSum, 'amount_paid')
            ->orderBy('id', 'desc')
            ->where('orders.verify', 0)
            ->with('orderCount')
            ->get();

        // $order_item = [];
        foreach ($bills as $bill) {
            $order_item = OrderItem::where('order_id', $bill->id)->get();
        }

        // $countOrderPaid = count($order_item);

        // $ordersbills = count($order_item);

        if ($bills) {
            return response()->json([
                'success' => true,
                'data' => $bills
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function total_verified()
    {
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])

            ->getQuery();


        $bills = Order::where('bill', '<=', 0)
            ->selectSub($amountSum, 'amount_verified')
            ->where('orders.verify', 1)
            ->orderBy('id', 'desc')
            // ->with('orderCount')
            ->first();

        if ($bills) {
            return response()->json([
                'success' => true,
                'data' => $bills
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
