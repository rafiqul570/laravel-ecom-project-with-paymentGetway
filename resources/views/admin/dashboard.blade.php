@extends('admin.layouts.template')
@section('content')

 <div class="row row-sm">
  <div class="col-sm-6 col-xl-3">
    <div class="card pd-20 bg-primary">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Product</h6>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_product}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->
  
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
    <div class="card pd-20 bg-info">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Orders</h6>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_order}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->
  
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="card pd-20 bg-purple">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Customers</h6>
        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_customer}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->
  
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="card pd-20 bg-sl-primary">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Revenue</h6>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">&#2547 {{$total_revenue}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->

  <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-20">
    <div class="card pd-20 bg-success">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Order Delivered</h6>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_deliverd}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->
  
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-20">
    <div class="card pd-20 bg-secondary">
      <div class="d-flex justify-content-between align-items-center mg-b-10">
        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Order Processing</h6>
      </div><!-- card-header -->
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_processing}}</h3>
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col-3 -->
</div><!-- row -->


@endsection
