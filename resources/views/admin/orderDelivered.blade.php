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
         <div class="table-responsive">
         	<h1 class="text-dark pb-4">All Orders</h1>
           <table id="datatable1" class="table table-striped table-info">
             <thead>
               <tr>
                 <th class="wd-15p">Name</th>
                 <th class="wd-10p">City</th>
                 <th class="wd-5p">Postcode</th>
                 <th class="wd-10p">Phone</th>
                 <th class="wd-5p">Product Quantity</th>
                 <th class="wd-5p">Ptice</th>
                 <th class="wd-10p">Payment Status</th>
                 <th class="wd-10p">Delivery Status</th>
                 <th class="wd-10p">Product Name</th>
                 <th class="wd-10p">Image</th>
                 <th class="wd-10p">Delivered</th>
                 <th class="wd-10p">Print PDF</th>
               </tr>
             </thead>
             @foreach($order as $data)
             <tbody>
               <tr>
               	<td>{{Auth::user()->name}}</td>
               	<td>{{$data->city}}</td>
               	<td>{{$data->postcode}}</td>
               	<td>{{$data->phone}}</td>
               	<td>{{$data->product_quantity}}</td>
               	<td>{{$data->product_price}}</td>
               	<td>{{$data->payment_status}}</td>
               	<td>{{$data->delivery_status}}</td>
               	<td>{{$data->product_name}}</td>
                 <td><img src="{{asset('/uploads/image/'.$data->product_img)}}" width="40" /></td>
                
                 <td>
                  @if($data->delivery_status=='processing')
                    
                    <a onclick="return confirm('Are you sure ?')" href="{{route('order.delivered', $data->id)}}"><span class="btn btn-info"> Delivered</span></a>
                  
                  @else

                  <p>Delivered</p>

                  @endif
                 </td>
                 <td>
                  <a href="{{route('admin.pdf.invoice', $data->id)}}" class="btn btn-info">PDF</a>
                </td>
               </tr>
             </tbody>
             @endforeach
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