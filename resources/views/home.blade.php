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
    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
      <div class="card h-100 shadow-sm border-0 position-relative">

        @if($data->discount_price)
          @php
            $discountPercent = round(100 - ($data->discount_price / $data->product_price) * 100);
          @endphp
          <span class="badge bg-danger position-absolute top-0 start-0 m-2">
            {{ $discountPercent }}% OFF
          </span>
        @endif

        <a href="{{ route('products', [$data->id, $data->slug]) }}">
          <img src="{{ asset('/uploads/image/' . $data->product_img) }}" class="card-img-top" alt="{{ $data->product_name }}">
        </a>

        <div class="card-body d-flex flex-column justify-content-between">
          <h6 class="card-title text-center">{{ Str::limit($data->product_name, 20) }}</h6>

          @if($data->discount_price)
            <p class="text-center fw-bold mb-1">
              <span class="text-danger fs-6">${{ $data->discount_price }}</span>
              <del class="text-muted ms-2 fs-6">${{ $data->product_price }}</del>
            </p>
          @else
            <p class="text-center text-dark fw-bold mb-1 fs-6">${{ $data->product_price }}</p>
          @endif

          <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('products', [$data->id, $data->slug]) }}" class="btn btn-outline-dark w-50 me-1">Buy Now</a>
            <a href="{{ route('products', [$data->id, $data->slug]) }}" class="btn btn-outline-warning w-50 ms-1">See More</a>
          </div>
        </div>
      </div>
    </div>

    @endforeach
    @endif 
  </div>
</div>

@endsection



