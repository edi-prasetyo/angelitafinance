<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'asc')
            ->withCount('appOrder')
            ->paginate(10);

        if ($customers) {
            return response()->json([
                'success' => true,
                'data' => $customers
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
