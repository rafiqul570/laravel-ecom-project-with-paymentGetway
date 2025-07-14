
@include('front.inc.mollaHeader')
<main class="main">
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
<div class="container d-flex align-items-center mb-2">
    <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href=" ">{{$product->category_name}}</a></li>
     <li class="breadcrumb-item"><a href=" ">{{$product->product_name}}</a></li>
    </ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <div class="product-details-top">
          <div class="card shadow" style="background: #ffffff;">
            <div class="row">
                <div class="col-md-4">
                    <div class="product-gallery product-gallery-vertical">
                          <div class="exzoom" id="exzoom">
                              <!-- Images -->
                              <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                @foreach($related_product as $data)
                                  <li class="justify-content: center ">
                                    <img src="{{asset('/uploads/image/'.$data->product_img)}}"/>
                                  </li>
                                @endforeach
                                </ul>
                              </div>
                              <div class="exzoom_nav"></div>
                              <!-- Nav Buttons -->
                              <p class="exzoom_btn">
                                  <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                  <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                              </p>
                            </div>
                      
                    </div><!-- End .product-gallery -->
           
                </div><!-- End .col-md-6 -->

                <div class="col-md-8">
                <form action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="product-details">
                        <h1 class="product-title" style="padding-top: 15px;">{{$product->product_name}}</h1>

                        
                        <div class="product-price my-5">
                            @if($product->discount_price > 0)
                                {{-- যদি ছাড়ের মূল্য থাকে এবং তা ০-এর চেয়ে বেশি হয় --}}
                                <span class="price">৳ {{ number_format($product->discount_price, 2) }}</span>
                                <span class="ms-5 text-muted"><del class="original-price fw-bold">৳ {{ number_format($product->product_price, 2) }}</del></span>
                            @else
                                {{-- যদি কোনো ছাড় না থাকে --}}
                                <span class="price">৳ {{ number_format($product->product_price, 2) }}</span>
                            @endif
                        </div><!-- End .product-price -->

                        <!-- Colors -->
                      
                        <!-- Display selected color name -->
                        @if($product->color_name)
                        <div class="mb-1">
                            <div class="color-radio d-flex flex-wrap gap-2">
                                <span class="product-price" style="font-size: 16px; margin-right:10px;">Color:</span>
                           
                                <input type="radio" id="color-radio" name="product_color" value="{{$product->color_name}}" checked hidden>
                                <label id="color-label" for="color-radio">{{$product->color_name}}</label>
                                
                            </div>
                        </div>
                      
                        
                        <!-- Related Product Colors -->
                        <div class="mb-3">
                            <div class="color-radio d-flex flex-wrap gap-2" style="margin-left: 50px;">
                                @foreach($related_product as $data)
                                <a href="{{route('products', [$data->id, $data->slug])}}" 
                                   class="color-hover-img" 
                                   data-color="{{$data->color_name}}" 
                                   onmouseenter="selectColor('{{$data->color_name}}')"
                                   onclick="event.preventDefault(); window.location.href=this.href;">
                                    <img src="{{asset('/uploads/image/'.$data->product_img)}}" width="40" />
                                </a>
                                @endforeach
                            </div>
                        </div>
                       @endif

                       @if($product->size_name)
                        <div class="details-filter-row details-row-size mb-3">
                          <label for="size">Select Size:</label>
                           <div class="d-flex flex-wrap">
                            <input type="radio" name="product_size" id="size-s" class="size-option" value="S">
                            <label for="size-s" class="size-label">S</label>

                            <input type="radio" name="product_size" id="size-m" class="size-option" value="M" checked>
                            <label for="size-m" class="size-label">M</label>

                            <input type="radio" name="product_size" id="size-l" class="size-option" value="L">
                            <label for="size-l" class="size-label">L</label>

                            <input type="radio" name="product_size" id="size-xl" class="size-option" value="XL">
                            <label for="size-xl" class="size-label">XL</label>
                           </div>
                         </div><!-- End .details-filter-row -->
                         @endif

                         </div><!-- End .details-filter-row -->
                         @if($product->product_quantity)
                         <label class="product-price btn-sm mb-3">Avelable Quantity: {{$product->product_quantity}}</label>
                         @else
                         <label class="product-price btn-sm mb-3">Out of stock</label>
                         @endif


                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" name="product_quantity" id="quantity" class="form-control" value="1" min="1" max="{{$product->product_quantity}}" step="1" data-decimals="0" required>
                            </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->

                        <!-- hidden option -->
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        
                        <input type="hidden" name="product_name" value="{{$product->product_name}}">
                        
                        <input type="hidden" name="product_img" value="{{$product->product_img}}">

                        @if($product->discount_price > 0)

                        <input type="hidden" name="discount_price" value="{{$product->discount_price}}">
                       
                        @else

                        <input type="hidden" name="product_price" value="{{$product->product_price}}">

                        @endif
                        
                        <input type="hidden" name="shippingCost" value="{{$product->shippingCost}}">

                        
                        <div class="product-details-action mt-5">
                            <button class="btn-product btn-cart">add to cart</button>
                        </div><!-- End .product-details-action -->

                    </div><!-- End .product-details -->
                    </form>
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
          </div>
        </div><!-- End .product-details-top -->

        <div class="container card shadow-sm mt-5 rounded-2">
        <div class="product-desc-content p-5">
            <h3 c>Description</h3>
            <p>{{$product->long_description}}</p>
            
        </div><!-- End .product-desc-content -->
    </div><!-- .End .tab-pane -->
  </div><!-- End .container -->
</div><!-- End .page-content -->
</main><!-- End .main -->
@include('front.inc.mollaFooter')
