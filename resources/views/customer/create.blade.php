<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <h1>Create New Product</h1>
    
    <form action="{{ url('products/create') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input name="product_name" value="{{ old('product_name') }}" placeholder="product name">
        @error('product_name') 
            <p>{{ $message }}</p>
        @enderror
        
        <textarea name="description" placeholder="Description" rows="3">{{ old('description') }}</textarea>
        @error('description') 
            <p>{{ $message }}</p>
        @enderror

        <input name="price" placeholder="price" value="{{ old('price') }}">
        @error('price') 
            <p>{{ $message }}</p>
        @enderror

        <input name="stock" value="{{ old('stock') }}" placeholder="stock">
        @error('stock') 
            <p>{{ $message }}</p>
        @enderror

        <input type="file" name="image" accept="image/*"> <!-- Added file input for image upload -->
        @error('image') 
            <p>{{ $message }}</p>
        @enderror

        <button type="submit" name="submit">Save</button>
        <a href="{{ url('products') }}"class="btn">Products</a>
    </form>
    @if(session('success'))
    <div class="message success">
        {{ session('success') }}
    </div>
    @endif
</body>
</html>