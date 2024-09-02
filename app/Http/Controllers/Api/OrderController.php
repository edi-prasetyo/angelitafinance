<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
// use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('id', 'asc')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->withCount('appOrder')
            ->with('appOrderItem')
            ->paginate(10);

        if ($orders) {
            return response()->json([
                'success' => true,
                'data' => $orders
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function unpaid()
    {

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('id', 'asc')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->withCount('appOrder')
            ->where('bill', '>', 0)
            ->with('appOrderItem')
            ->paginate(10);

        if ($orders) {
            return response()->json([
                'success' => true,
                'data' => $orders
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function paid()
    {
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('id', 'asc')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->withCount('appOrder')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])
            ->where('bill', '=', 0)
            ->with('appOrderItem')
            ->paginate(10);

        if ($orders) {
            return response()->json([
                'success' => true,
                'data' => $orders
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function cancel()
    {
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('id', 'asc')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->withCount('appOrder')
            ->where(['orders.status' => 1, 'orders.cancel' => 0])

            ->with('appOrderItem')
            ->paginate(10);

        if ($orders) {
            return response()->json([
                'success' => true,
                'data' => $orders
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }

    public function get_orders()
    {
        $orders = OrderItem::all();
        $count_orders = count($orders);
        return response()->json(
            $count_orders,
            200,
            [],
            JSON_NUMERIC_CHECK
        );
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $order_items = OrderItem::where('order_id', $id)->get();

        if ($order_items) {
            return response()->json([
                'success' => true,
                'data' => $order_items
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function get_payments($order_id)
    {
        $payments = Payment::where('order_id', $order_id)->get();

        if ($payments) {
            return response()->json([
                'success' => true,
                'data' => $payments
            ], 200, [], JSON_NUMERIC_CHECK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
