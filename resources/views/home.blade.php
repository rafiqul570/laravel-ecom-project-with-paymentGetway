@php      
  $allProduct = App\Models\Product::latest()->get();     
@endphp

@extends('front.layouts.template')
@include('front.inc.header')
@include('front.inc.hero')
@include('front.inc.slaider')
@section('content')

 <!-- Main contant Section-->
<div class="container">
    <h2 class="text-center my-5">Featured Product</h2>
    <div class="row my-5">
        
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
        </div>
    </div>
  
@endsection