<div class="container-fluid mt-5">
  <div class="row">
    <!-- Filter Sidebar -->
    <div class="col-md-3">
      <!-- Search -->
       <!-- <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search products..."> -->
      <div class="accordion" id="filterAccordion">

        <!-- Category -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
              Category
            </button>
          </h2>
          <div id="collapseCategory" class="accordion-collapse collapse show">
            <div class="accordion-body" id="filterCategory">
              @foreach($categories as $product)
              <div><input type="checkbox" value="{{$product->category_name}}" name="category_name"> {{$product->category_name}}</div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Sub-Category -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubCategory">
              Sub-Category
            </button>
          </h2>
          <div id="collapseSubCategory" class="accordion-collapse collapse">
            <div class="accordion-body" id="filterSubCategory">
                @foreach($subCategories as $product)
              <div><input type="checkbox" value="{{$product->subCategory_name}}" name="subCategory_name"> {{$product->subCategory_name}}</div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Brand -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
              Brand
            </button>
          </h2>
          <div id="collapseBrand" class="accordion-collapse collapse">
            <div class="accordion-body" id="filterBrand">
               @foreach($brands as $product)
              <div><input type="checkbox" value="{{$product->brand_name}}" name="brand_name"> {{$product->brand_name}}</div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Color -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColor">
              Color
            </button>
          </h2>
          <div id="collapseColor" class="accordion-collapse collapse">
            <div class="accordion-body" id="filterColor">
              @foreach($colors as $product)
              <div><input type="checkbox" value="{{$product->color_name}}"> {{$product->color_name}}</div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Size -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSize">
              Size
            </button>
          </h2>
          <div id="collapseSize" class="accordion-collapse collapse">
            <div class="accordion-body" id="filterSize">
               @foreach($sizes as $product)
              <div><input type="checkbox" value="{{$product->size_name}}" name="size_name"> {{$product->size_name}}</div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Price -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
              Price Range
            </button>
          </h2>
          <div id="collapsePrice" class="accordion-collapse collapse">
            <div class="accordion-body" id="filterPrice">
              <div><input type="checkbox" value="0-100"> $0 - $100</div>
              <div><input type="checkbox" value="100-500"> $100 - $500</div>
              <div><input type="checkbox" value="500-1000"> $500 - $1000</div>
            </div>
          </div>
        </div>

      </div>
    </div>