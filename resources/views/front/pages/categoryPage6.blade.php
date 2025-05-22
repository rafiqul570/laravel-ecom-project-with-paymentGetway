@extends('product.layouts.shopTemplate')
@section('content')

<div class="container">
    <!-- <h2 class="pt-5">{{$allCategory->category_name}} - ({{$allCategory->product_count}})</h2> -->
    <h2 class="pt-5">{{$allCategory->category_name}}</h2>
   <div class="row my-5">
            @if($allProduct->isEmpty())
                <h3 class="text-danger">Data Not Found</h3>
            @else

            @foreach ($allProduct as $data)
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
         @endif   
        </div>
   </div>


@endsection
