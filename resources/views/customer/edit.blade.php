<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
        }
        form button {
            width: 10%;
            padding: 10 15px;
            margin-top: 3px;
        }
        input ,
        textarea{
            width: 25%;
            margin-top: 5px;
            padding: 10px 15px
        }
    </style>
</head>
<body>
    <h1>Edit sad</h1>
    <form action="{{ url('products/'. $product->id .'/edit') }}" method="post">
        @csrf
        @method('PUT')
        
        <!-- Display the product name with current value -->
        <label for="product_name">Product Name:</label>
        <input name="product_name" type="text" id="product_name" placeholder="Product Name" value="{{ old('product_name', $product->product_name) }}">
        @error('product_name') <p>{{ $message }}</p> @enderror

        <!-- Display the product description with current value -->
        <label for="description">Description:</label>
        <textarea name="description" placeholder="Description" rows="3">{{ old('description', $product->description)}}</textarea>
        @error('description') <p>{{ $message }}</p> @enderror

        <!-- Display the product price with current value -->
        <label for="price">Price:</label>
        <input name="price" type="text" id="price" placeholder="Price" value="{{ old('price', $product->price) }}">
        @error('price') <p>{{ $message }}</p> @enderror

        <!-- Display the product stock with current value -->
        <label for="stock">Stock:</label>
        <input name="stock" type="text" id="stock" placeholder="Stock" value="{{ old('stock', $product->stock) }}">
        @error('stock') <p>{{ $message }}</p> @enderror

        <!-- Submit button -->
        <button type="submit">Update</button>
        {{-- <a href="{{ url('products/' . $product->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this product?');" style="color: red;">Delete</a> --}}
    </form>
    @if(session('status'))
    <div class="message success">
        {{ session('status') }}
    </div>
    @endif
</body>
</html>
