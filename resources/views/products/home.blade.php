<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    
    <input type="text" id="search" placeholder="Search products...">

    
        <div id="product-table">
            @if ($products->isEmpty())
                <h1>No products found.</h1>
            @else
            <div class="container">
                <div class="row g-3 d-flex"> <!-- g-3 adds a gap of 1rem (16px) between columns -->   
                    @foreach ($products as $product)
                    {{-- <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ url('products/' . $product->id . '/edit') }}">Edit</a>
                            <form action="{{ url('products/' . $product->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Delete</button>
                            </form>
                        </td>
                    </tr> --}}
                    <div class="col-md-4 d-flex"> <!-- g-3 adds a gap of 1rem (16px) between columns -->
                        <div class="card mb-3 flex-fill" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center align-items-center"> <!-- Added flex classes -->
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmdVMKRyh4OsqO66gXwFLdpGPvScJoPXRdow&s" class="img-fluid rounded-start ms-3" alt="..."> <!-- Example image -->
                                </div>
                                <div class="col-md-8 text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><small class="text-body-secondary">{{ $product->price }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    

    <a href="{{ route('products.create') }}">Create New Product</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var query = $(this).val();
                $.ajax({
                    url: '{{ route("products.search") }}',
                    data: { query: query },
                    success: function(response) {
                        $('#product-table').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors
                    }
                });
            });
        });
    </script>
</body>
</html>