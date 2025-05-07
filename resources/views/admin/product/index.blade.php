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

    <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
      <div class="d-flex justify-content-between">
        <h3 class="text-dark pb-3">All Product</h3>
        <h5 class="mb-3"><a  href="{{route('admin.product.create')}}" class="btn btn-info text-light">Add Product</a></h5>
      </div>
        
         <div class="table-responsive">
           <table id="datatable1" class="table table-striped table-info">
             <thead>
               <tr>
                 <th class="wd-10p">SL</th>
                 <th class="wd-50p">Product Name</th>
                 <th class="wd-25p">Image</th>
                 <th class="wd-15p">action</th>
               </tr>
             </thead>

             <tbody>
                @foreach ($allProduct as $key => $data)
               <tr>
                 <td>{{++$key}}</td>
                 <td>{{$data->product_name}}</td>
                 <td>
                  <img src="{{asset('uploads/image/'.$data->product_img)}}" width="80" alt="">
                  <br>
                  <a class="btn btn-sm btn-primary mt-2" href="{{route('admin.product.editImage', $data->id)}}">Update Image</a> 
                </td>
                
                 <td>
                    <a href="{{route('admin.product.edit', $data->id)}}">Edit</a> ||
                    <a onclick="return confirm('Are you sure ?')" href="{{route('admin.product.delete', $data->id)}}">Delete</a>
                 </td>
               </tr>
               @endforeach
             </tbody>
          </table>
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
