@extends('front.pages.layouts.pageTemplate')
@section('content')

    <div class="container">
    <div class="row">
    <h2 class="my-5">Products in {{ $subCategory->subCategory_name }} ({{ $products->total() }})</h2>

    @if($products->isEmpty())
        <p>No products available in this category.</p>
    @else
   
    @foreach($products as $data)
    <div id="home" class="col-md-3">
            <div class="card shadow-sm">
            <a href="{{route('products', [$data->id, $data->slug])}}"><img src="{{asset('/uploads/image/'.$data->product_img)}}"></a>
            <p class="text-center">{{Str::limit($data->product_name, 15)}}</p><br>
            <h6 class="text-center"><span class="text-danger">price</span> ${{$data->product_price}}</h6>
            <div class="d-flex justify-content-between mt-5">
            <button class="btn btn-dark"><a class="text-light" href="{{route('products', [$data->id, $data->slug])}}">Buy Now</a></button>
            <button class="btn btn-warning"><a class="text-dark" href="{{route('products', [$data->id, $data->slug])}}">See More</a></button>
            </div>
        </div>
       </div>
    @endforeach
</div>
</div>
    <!-- Pagination links -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endif


@endsection
