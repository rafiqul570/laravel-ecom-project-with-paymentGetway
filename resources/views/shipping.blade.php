
@include('front.inc.mollaHeader')
<main class="main">
<nav aria-label="breadcrumb" class="breadcrumb-nav">
<div class="container">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('billing.create')}}">Shipping</a></li>
    <li class="breadcrumb-item active" aria-current="page">Shipping & Billing</li>
</ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
<div class="checkout">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card shadow-sm mb-1 bg-light p-4">
				<div class="d-flex justify-content-between">
					<h2 class="mb-2">Shipping & Billing</h2>
					<a href="">
					<h3 class="mb-2">EDIT</h3>	
					</a>
				</div>
				
				<table>
					@foreach($shippingAddress as $address)
					<tbody>
						<tr>
							<td><span class="text-info">Address - </span>{{$address->address}}</td>
						</tr>

						<tr>
							<td><span class="text-info">City - </span>{{$address->city}}</td>
						</tr>

						<tr>
						<tr>
							<td><span class="text-info">Postcode - </span>{{$address->postcode}}</td>
						</tr>

						<tr>
							<td><span class="text-info">Phone number - </span>{{$address->phone}}</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>

			<div class="card shadow-sm mb-1 bg-light p-4">
				<table class="table table-cart table-mobile">
					<thead>
						<tr>
							<th>Product</th>
							<th>Price</th>
							<th>Quantity</th>
						</tr>
					</thead>
					@foreach($cartItems as $item)

                    @php 
                    $productImage = App\Models\Product::where('id', $item -> product_id)->value('product_img'); 
                    @endphp
					<tbody>
						<tr>
							<td class="product-col">
							<div class="product">
							<figure class="product-media">
				  
								<img src="{{asset('/uploads/image/'.$productImage)}}" width="40" />
					 
							</figure>

							<h3 class="product-title">
								{{$item -> product_name}}
							</h3><!-- End .product-title -->
						   </div><!-- End .product -->
							</td>
							<td class="price-col">&#2547 {{$item ->product_price}}</td>
							<td class="price-col">{{$item ->product_quantity}}</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
		</div>
		<div class="col-md-4"> 
			<div class="card shadow-sm mb-1 bg-light p-4">
				<h3 class="summary-title">Order Summary</h3><!-- End .summary-title -->

				<table class="table table-summary">
					<tbody>
						<tr class="summary-subtotal">
							<td>Items Total (<span id="cart-count2">0 </span>Items)</td>
							<td id="cart-total">&#2547 {{ number_format($total, 2) }}</td>
						</tr><!-- End .summary-subtotal -->

						<tr class="summary-shipping-row">
							<td>Delivery Fee</td>
							<td>&#2547 {{ number_format($shippingCost, 2) }}</td>
						  </tr><!-- End .summary-shipping-row -->
						 
						 <tr class="summary-total">
							<td>Total</td>
							<td><strong id="cart-grandtotal">&#2547 {{ number_format($grand_total, 2) }}</strong></td>
						</tr><!-- End .summary-total -->
					</tbody>
				</table><!-- End .table table-summary -->
				
				 <a href="{{route('payment')}}">
				 <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">Proceed to pay</button>
				 </a>
			</div>
		</div>
	</div>

</div><!-- End .container -->
</div><!-- End .checkout -->
</div><!-- End .page-content -->
</main><!-- End .main -->

@include('front.inc.mollaFooter')