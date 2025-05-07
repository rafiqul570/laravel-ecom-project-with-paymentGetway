@extends('admin.layouts.template')
@section('content')

   <div class="card pd-20 pd-sm-40 bg-info">
      <h2 class="card-body-title mb-5">Add New Product</h2>
      <div class="form-layout">
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="row mg-b-25">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Product name</label>
              <input class="form-control" type="text" name="product_name" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_name')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Product price</label>
              <input class="form-control" type="number" name="product_price" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_price')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Quantity</label>
              <input class="form-control" type="number" name="product_quantity" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_quantity')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Short Description</label>
              <textarea  rows="4" class="form-control" name="short_description" placeholder="Enter product short description" ></textarea>
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('short_description')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Long Description</label>
              <textarea  rows="10" class="form-control" name="long_description" placeholder="" id="description"></textarea>
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('long_description')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Category</label>
              <select class="form-control select2" name="category_id" data-placeholder="Choose one"
              data-parsley-class-handler="#slWrapper"
              data-parsley-errors-container="#slErrorContainer" required>
              <option selected="" disabled="">Select Category</option>
              @foreach ($allCategory as $data)
              <option value="{{$data->id}}">{{$data->category_name}}</option>
              @endforeach
              </select>
            </div>
          </div><!-- col-12 -->

           <div class="col-lg-12">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Color</label>
              <select class="form-control select2" name="color_id" data-placeholder="Choose one"
              data-parsley-class-handler="#slWrapper"
              data-parsley-errors-container="#slErrorContainer" required>
              <option selected="" disabled="">Select Color</option>
              @foreach ($allColor as $data)
              <option value="{{$data->id}}">{{$data->color_name}}</option>
              @endforeach
              </select>
            </div>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group mg-b-10-force">
              <label class="form-control-label">Shippingcost</label>
              <select class="form-control select2" name="shippingCost" data-placeholder="Choose one"
              data-parsley-class-handler="#slWrapper"
              data-parsley-errors-container="#slErrorContainer" required>
              <option selected="" disabled="">Select Shippingcost</option>
              @foreach ($shippingCost as $data)
              <option value="{{$data->shippingcost}}">{{$data->shippingcost}}</option>
              @endforeach
              </select>
            </div>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Upload Product Image</label>
              <input class="form-control" type="file" name="product_img" value="John Paul" placeholder="Enter firstname">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_img')" class="mt-2 " />
              </h6>
          </div><!-- col-12 -->
        </div><!-- row -->

        <div class="form-layout-footer">
          <button class="btn btn-secondary mg-r-5">Add Product</button>
          <button class="btn btn-secondary">Cancel</button>
        </div><!-- form-layout-footer -->
      </form>
      </div><!-- form-layout -->
    </div><!-- card -->


@endsection
