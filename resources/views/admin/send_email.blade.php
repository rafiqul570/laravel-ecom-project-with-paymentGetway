@extends('admin.layouts.template')
@section('content')

   <div class="card pd-20 pd-sm-40 bg-info">
      <h2 style="color:white;" class="card-body-title mb-5 text-lowercase">Send Email to {{$order->email}}</h2>
      <div class="form-layout">
        <form action="{{route('admin.send_user_email', $order->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="row mg-b-25">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email Greeting</label>
              <input class="form-control" type="text" name="greeting" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_name')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email First Line</label>
              <input class="form-control" type="text" name="firstline" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_price')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

             <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email Body</label>
              <input class="form-control" type="text" name="body" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_price')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email Button</label>
              <input class="form-control" type="text" name="button" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_quantity')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

            <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email Url</label>
              <input class="form-control" type="text" name="url" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_price')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Email Last Line</label>
              <input class="form-control" type="text" name="lastline" placeholder="">
            </div>
            <h6 class="col-sm-12 d-flex justify-content-center">
               <x-input-error :messages="$errors->get('product_price')" class="mt-2 " />
            </h6>
          </div><!-- col-12 -->

        <div class="form-layout-footer">
          <button class="btn btn-secondary mg-r-5">Send Email</button>
          <button class="btn btn-secondary">Cancel</button>
        </div><!-- form-layout-footer -->
      </form>
      </div><!-- form-layout -->
    </div><!-- card -->


@endsection
