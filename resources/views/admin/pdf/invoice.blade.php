<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order PDF</title>
</head>
<body>
	<h1>Order Detail</h1>
	Customer Name: <h3>{{Auth::user()->name}}</h3>
	City: <h3>{{$order->city}}</h3>
	Postcode: <h3>{{$order->postcode}}</h3>
	Phone number: <h3>{{$order->phone}}</h3>
	Product name: <h3>{{$order->product_name}}</h3>
	Product color: <h3>{{$order->product_color}}</h3>
	Product size: <h3>{{$order->product_size}}</h3>
	<img src="uploads/image/{{$order->product_img}}" width="40" />
	Price: <h3>{{$order->product_price}}</h3>
	Quantity: <h3>{{$order->product_quantity}}</h3>
	Payment Status: <h3>{{$order->payment_status}}</h3>

</body>
</html>