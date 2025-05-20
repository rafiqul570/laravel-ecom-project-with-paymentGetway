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
          <h3 class="text-dark pb-3">Add New Brand</h3>
          <h5><a  href="{{route('admin.brand.index')}}" class="btn btn-light text-dark">All Brand</a></h5>
          </div>
          <form action="{{route('admin.brand.store')}}" method="POST">
            @csrf
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-group">Brand name</label>
                <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
              <h6 class="col-sm-12 d-flex justify-content-center">
              <x-input-error :messages="$errors->get('brand_name')" class="mt-2 " />
              </h6>
             </div>
            </div>
          </div>


          <div class="row row-xs mg-t-30">
              <div class="col-sm-12">
                <div class="form-layout-footer">
                  <button class="btn btn-light mg-r-5">Add Brand</button>
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
