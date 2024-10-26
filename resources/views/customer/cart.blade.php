<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle; /* Center-align content vertically */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Your Shopping Cart</h2>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        @if(session()->has('cart') && count(session('cart')) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0; // Initialize total amount
                    @endphp
    
                    @foreach(session('cart') as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalAmount += $itemTotal; // Calculate total amount
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" required class="form-control me-2" style="width: 80px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>${{ number_format($itemTotal, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="d-flex justify-content-between mt-4">
                <h5>Total Amount: ${{ number_format($totalAmount, 2) }}</h5>
            </div>

            <!-- Checkout Form -->
            <h4 class="mt-4">Checkout</h4>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Shipping Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your shipping address" required>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="" disabled selected>Select a payment method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <!-- Add more payment methods as needed -->
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>
        @else
            <div class="alert alert-warning">Your cart is empty.</div>
        @endif
    </div>
</body>
</html>