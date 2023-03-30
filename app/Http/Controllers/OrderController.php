<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->withCount('products')
            ->with(['user'])
            ->get();

        return view('orders.index')
            ->with('orders', $orders);
    }

    public function create()
    {
        return view('orders.create')
            ->with('users', User::pluck('name', 'id')->prepend('Select a user', ''));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->only(['user_id', 'date']));

        foreach ($request->validated('products') as $product) {
            $order->products()->create($product);
        }

        return to_route('orders.index');
    }
}
