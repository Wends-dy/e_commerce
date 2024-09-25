{{-- <div class="container">
    <div class="row g-3 d-flex">
        @if ($products->isEmpty())
            <h1>No products found.</h1>
        @else
            @foreach ($products as $product)
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
        @endif
    </div>
</div> --}}

<div class="container">
    <div class="heading_container heading_center">
    @if ($products->isEmpty())
        <h1>No products found.</h1>
    @else
    </div>
    <div class="row">
      @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
        
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('storage/'. $product->image) }}" alt="Logo">
            </div>
            <div class="detail-box">
              <h6>
                {{ $product->product_name }}
              </h6>
              <h6>
                Price
                <span>
                  {{ $product->price }}
                </span>
              </h6>
            </div>
            <p class="mt-2 mb-0"> <!-- Added margin-top to separate from price -->
              {{ $product->description }} <!-- Assuming you have a description field in your product model -->
            </p>
            
            <a class="text-decoration-none" href="{{ url('products/' . $product->id . '/edit') }}" style="color: rgb(70, 216, 12);">Edit</a>
            <form action="{{ url('products/' . $product->id .'/delete') }}" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit" style="color: red; background: none; border: none; cursor: pointer;">Delete</button>
            </form>
          </div>
        
        </div>
      @endforeach
    </div>
    @endif
</div>