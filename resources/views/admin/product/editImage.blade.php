@extends('admin.layouts.template')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
</head>
<body>
    <div class="row">
     <div class="col-md-12">
       <div class="card pd-20 pd-sm-40 form-layout form-layout-5 text-light bg-info">
       <div class="d-flex justify-content-between">
          <h3 class="text-dark pb-3">Image Update</h3>
          <h5><a href="{{route('admin.product.index')}}" class="btn btn-light text-dark">All Product</a></h5>
          </div>
          <form action="{{route('admin.product.updateImage')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" value="{{$product->id}}" name="id">
   
            <div class="row">
                <label class="col-sm-2 form-control-label"><span class="tx-danger"></label>
                <div class="col-sm-10 mg-t-10 mg-sm-t-0 mt-2">
                    <img class="mb-3" src="{{asset('uploads/image/'.$product->product_img)}}" alt="" width="150">
                </div>
                <h6 class="col-sm-12 d-flex justify-content-center">
                </h6>
                </div>

                <div class="row">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Upload Image :</label>
                    <div class="col-sm-10 mg-t-10 mg-sm-t-0 mt-2">
                        <input type="file" name="product_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <h6 class="col-sm-12 d-flex justify-content-center">
                    </h6>
                    </div>

                <div class="row row-xs mg-t-30">
                    <div class="col-sm-12" >
                    <div class="form-layout-footer" >
                        <button  class="btn btn-light mg-r-5">Update Image</button>
                    </div><!-- form-layout-footer -->
                    </div><!-- col-8 -->
                </div>
            </form>
            </div><!-- card -->
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

        <script>
            @if (Session::has('success'))
                toastr.success("{{Session::get('success')}}");
            @endif
        </script>
        
        </body>
    </html>

@endsection
