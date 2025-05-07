  @php
  $allCategory = App\Models\Category::latest()->get();      
  $allProduct = App\Models\Product::latest()->get();   
  @endphp 

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                     @foreach ($allProduct as $data)
                    <div id="slaider" class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                            <h5><a href="{{route('front.pages.singleProduct', [$data->id, $data->slug])}}"><img class="mig1" src="{{asset('/uploads/image/'.$data->product_img)}}"></a></h5>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>  
        </div>
    </section>
<!-- Categories Section End -->