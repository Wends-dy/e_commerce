<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
    @import url("font-awesome.min.css");
    body {
        font-family: "poppins", sans-serif;
        color: #101010;
        background-color: #ffffff;
    }
    h2{
      padding: 0;
    }
    .shop_section .heading_container {
      margin-bottom: 20px;
    }

    .shop_section .box {
      background-color: #eeeeee;
      padding: 15px;
      margin-top: 25px;
    }

    .shop_section .box a {
      color: #000000;
    }

    .shop_section .box .img-box {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      padding: 10px 20px;
      height: 200px;
    }

    .shop_section .box .img-box img {
      max-width: 100%;
      max-height: 145px;
    }

    .shop_section .box .detail-box h6 span {
      color: #db4f66;
    }


    .shop_section .btn-box a:hover {
      background-color: transparent;
      color: #f16179;
    }

    .shop_container {
      padding-left: 50px;
      padding-top: 60px; 
    }

    .header {
      background-color: #ebeef0;
      padding: 10px 0;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }
    
    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      text-decoration: none;
    }
    
    .search-form {
      display: flex;
      justify-content: flex-end;
    }
    
    .search-form .form-control {
      border-radius: 20px;
      padding: 6px 20px;
    }
    
  </style>
</head>
<body>  
  <header class="header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <a href="#" class="logo">
            E_commerce
          </a>
        </div>
        <div class="col-md-6">
          <div class="container text-center">
            <form class="search-form d-flex justify-content-center align-items-center">
              <input id="search" class="form-control me-2" placeholder="Search..." style="width: auto;">
              
              <div class=" align-items-center">
                <a class="btn btn-primary" href="{{ url('products/create') }}">Create Product</a>
                
                <a class="btn" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
              </div>
            </form>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </div>
        
        
      </div>
    </div>
  </header>

  <main class="shop_container">
    
    <section class="shop_section layout_padding" id="product-table">
      @if ($products->isEmpty())
        <h1>No products found.</h1>
      @else
      <div class="container">
        
          <h2>
            Latest Products
          </h2>
        
        <div class="row">
          @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
             
              <div class="img-box">
                <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->product_name }}">
                  {{-- <img src="{{ asset('images/cbr.jpg') }}" alt="Product Image" class="img-fluid"> --}}
              </div>
              <div class="detail-box">
                <h6 class="mb-1">
                  {{ $product->product_name }}
                </h6>
                <h6 class="mb-1">
                  Price: 
                  <span class="text-success">
                    {{ $product->price }}
                  </span>
                  <h6 class="mb-1">
                    Stocks: 
                    <span class="text-success">
                      {{ $product->stock }}
                    </span>
                  </h6>
                </h6>
                
              </div>
              <p class="mt-2 mb-0"> 
                {{ $product->description }} 
              </p>
              <a class="btn btn-warning btn-sm" href="{{ url('products/' . $product->id . '/edit') }}">Add Cart</a>
              {{-- <a style="color: rgb(70, 216, 12);" class="text-decoration-none" href="{{ url('products/' . $product->id . '/edit') }}">Edit</a>
              <form action="{{ url('products/' . $product->id .'/delete') }}" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" style="color: red; background: none; border: none; cursor: pointer;">Delete</button>
              </form> --}}
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif
  </main>


  
 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    /*
      this code ready us to retrieve the values in search input user.
      The code enables real-time product searches using AJAX,
      allowing users to view results instantly without refreshing the page.
    */
    $(document).ready(function() { 
      $('#search').on('input', function() {
        var query = $(this).val();
        $.ajax({
          url: '{{ route("products.search") }}',
          data: { query: query },
          success: function(response) {
            $('#product-table').html(response);
          },
        });
      });
    });
  </script>
</body>
</html>