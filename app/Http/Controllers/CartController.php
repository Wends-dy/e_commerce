<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        // Retrieve the cart items from the session
        $cart = session()->get('cart', []);

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Pass the cart items and total amount to the view
        return view('customer.cart', compact('cart', 'totalAmount'));
    }
    //
    public function addToCart(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find product by ID
        $product = Product::findOrFail($id);

        // Get current cart from session or initialize it
        $cart = session()->get('cart', []);

        // Check if product already exists in cart
        if (isset($cart[$id])) {
            // Update quantity if it already exists
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "photo" => $product->image,
                "stock" => $product->stock,
            ];
        }

        // Store updated cart back in session
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function updateCart(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get current cart from session
        $cart = session()->get('cart');

        if ($request->id && isset($cart[$request->id])) {
            // Update quantity in cart
            if ($request->quantity > 0) {
                $cart[$request->id]['quantity'] = $request->quantity;
            } else {
                unset($cart[$request->id]); // Remove item if quantity is zero or less
            }
            
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function removeItem(Request $request)
    {
        // Get current cart from session
        $cart = session()->get('cart');

        if ($request->id && isset($cart[$request->id])) {
            unset($cart[$request->id]); // Remove item from cart
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }
    
    public function checkout(Request $request)
    {
        // Retrieve the cart items from the session
        $cart = session()->get('cart', []);
    
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Validate payment details
        $request->validate([
            'payment_method' => 'required|string',
            'address' => 'required|string',
            // Add more fields as necessary
        ]);
    
        // Process payment (this is a placeholder; implement your payment logic here)
        $paymentSuccess = $this->processPayment($request->payment_method, $this->calculateTotalAmount($cart));
    
        if (!$paymentSuccess) {
            return redirect()->route('cart.show')->with('error', 'Payment failed. Please try again.');
        }
    
        // Create a new order
        $order = Order::create([
            'user_id' => Auth::id(),  // Use Auth::id() to get the authenticated user's ID
            'total_amount' => $this->calculateTotalAmount($cart),
            'payment_status' => 'Completed', // Set payment status
            'shipping_status' => 'Pending', // Set initial shipping status
            'address' => $request->address, // Save the shipping address
            'payment_method' => $request->payment_method, // Save the payment method
        ]);
    
        // Create order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id, // Make sure this is the correct property
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

              // Decrease product stock
              $product = Product::find($id);

              if ($product) {
                  // Check if enough stock is available
                  if ($product->stock >= $item['quantity']) {
                      $product->stock -= $item['quantity']; // Decrease stock
                      $product->save(); // Save changes to the database
                  } else {
                      // Handle insufficient stock scenario
                      throw new \Exception("Insufficient stock for product ID: {$id}");
                  }
              } else {
                  throw new \Exception("Product not found for ID: {$id}");
              }

            // $this->decreaseProductStock($id, $item['quantity']);
        }
    
        // Clear the cart from session after successful payment
        session()->forget('cart');
    
        return redirect()->back()->with('success', 'Checkout successful! Thank you for your purchase.');
    }

    protected function decreaseProductStock($productId, $quantity)
    {
        $product = Product::find($productId);
    
        if ($product) {
            // Check if enough stock is available
            if ($product->stock >= $quantity) {
                $product->stock -= $quantity; // Decrease stock
                $product->save(); // Save changes to the database
            } else {
                // Handle insufficient stock scenario
                throw new \Exception("Insufficient stock for product ID: {$productId}");
            }
        } else {
            throw new \Exception("Product not found for ID: {$productId}");
        }
    }

    private function processPayment($method, $amount)
    {
        // Implement your payment processing logic here
        // This is just a placeholder for demonstration purposes
        return true; // Assume payment is successful for now
    }

    private function calculateTotalAmount($cart)
    {
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        return $totalAmount;
    }
}
