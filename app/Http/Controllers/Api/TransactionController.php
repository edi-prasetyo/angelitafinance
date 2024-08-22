<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
// use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
            ]);
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
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
