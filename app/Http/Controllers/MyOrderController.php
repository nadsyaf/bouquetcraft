<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->with(['wrapper', 'orderDetails.flower'])
            ->latest()
            ->paginate(10);

        return view('customer.my-orders', compact('orders'));
    }
}