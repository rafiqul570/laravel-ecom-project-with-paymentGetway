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
        <h3 class="text-dark pb-3">All Subcategory</h3>
        <h5><a  href="{{route('admin.subCategory.create')}}" class="btn btn-info text-light">Add Subcategory</a></h5>
      </div>
        
         <div class="table-responsive">
           <table id="datatable1" class="table table-striped table-info">
             <thead>
               <tr>
                 <th class="wd-10p">SL</th>
                 <th class="wd-25p">Subcategory name</th>
                 <th class="wd-20p">Slug</th>
                 <th class="wd-15p">Category name</th>
                 <th class="wd-15p">Product Count</th>
                 <th class="wd-15p">action</th>
               </tr>
             </thead>

             <tbody>
                @foreach ($allSubCategory as $key => $data)
               <tr>
                 <td>{{++$key}}</td>
                 <td>{{$data->subcategory_name}}</td>
                 <td>{{$data->slug}}</td>
                 <td>{{$data->category_name}}</td>
                 <td>{{$data->product_count}}</td>
                 <td>
                    <a href="{{route('ecom_subcategory.edit', $data->id)}}">Edit</a> ||
                    <a onclick="return confirm('Are you sure ?')" href="{{route('ecom_subcategory.delete', $data->id)}}">Delete</a>
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
