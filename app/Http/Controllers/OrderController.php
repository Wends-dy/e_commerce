<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create(Request $request)
    {
        // Validate request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'payment_status' => 'Pending',
            'shipping_status' => 'Pending',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Return a response
        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order->load('items'), // Load the order with its items
        ], 201);
    }
}
