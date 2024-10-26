<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/product/'. $product->id .'/edit') }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input name="product_name" type="text" id="product_name" class="form-control" placeholder="Product Name" value="{{ old('product_name', $product->product_name) }}" required>
                        @error('product_name') 
                            <div class="text-danger">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" rows="3">{{ old('description', $product->description) }}</textarea>
                        @error('description') 
                            <div class="text-danger">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" id="price" class="form-control" placeholder="Price" value="{{ old('price', $product->price) }}" required>
                        @error('price') 
                            <div class="text-danger">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input name="stock" type="text" id="stock" class="form-control" placeholder="Stock" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock') 
                            <div class="text-danger">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success btn-block">Update</button>

                    {{-- Uncomment if delete functionality is needed --}}
                    {{-- 
                    <a href="{{ url('products/' . $product->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger btn-block mt-2">Delete</a> 
                    --}}
                </form>

                @if(session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>