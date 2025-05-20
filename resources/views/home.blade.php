@extends('inc.layouts.homeTemplate')

@section('content')

<!-- Featured Products Section -->
<div class="container mt-5">
  <h4 class="mb-4 fw-bold">Featured Products</h4>
  <div class="row g-4">
    <!-- Product 1 -->
    @if($allProduct->isEmpty())
    <p>No products found.</p>
    @else
    @foreach ($allProduct as $data)
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div id="home" class="card h-100 shadow-sm border-0">
        <a href="{{route('products', [$data->id, $data->slug])}}"><img src="{{asset('/uploads/image/'.$data->product_img)}}"></a>
        <div class="card-body">
          <h6 class="card-title text-center">{{Str::limit($data->product_name, 15)}}</h6>
          <p class="card-text text-danger text-center fw-bold mb-1">${{$data->product_price}}</p>
          <div class="d-flex justify-content-between mt-5">
          <button class="btn btn-dark"><a class="nav-link text-light" href="{{route('products', [$data->id, $data->slug])}}">Buy Now</a></button>
          <button class="btn btn-warning"><a class="nav-link text-dark" href="{{route('products', [$data->id, $data->slug])}}">See More</a></button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif 
  </div>
</div>

@endsection



