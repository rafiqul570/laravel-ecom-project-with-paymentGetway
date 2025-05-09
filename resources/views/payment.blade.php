
@include('front.inc.mollaHeader')
<main class="main">
<nav aria-label="breadcrumb" class="breadcrumb-nav">
<div class="container">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('shipping')}}">Shipping</a></li>
    <li class="breadcrumb-item active" aria-current="page">Payment</li>
</ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
<div class="checkout">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card shadow-sm mb-1 bg-light p-4">
			 <span style="font-size: 18px; color: #000; font-weight: 500;" class="mb-2">Select Payment Method</span>
			 <div style="display: inline-flex; column-gap: 30px;">
			 	
			 	<form onclick="return confirm('Order Confirm?')" action="{{route('order.store')}}" method="POST"> 
				 @csrf
			 	<button type="submit" style="font-size: 24px;" class="btn btn-outline-primary-2 btn-order btn-block">Cash on delivery</button>
			 	
			 	</form>
			 	 <form action="{{route('bkash-create-payment')}}" method="POST"> 
				 @csrf
			 	<button type="submit" style="font-size: 24px;" class="btn btn-outline-primary-2 btn-order btn-block">Bkash</button>
			 	</form>
			 	
			 </div>
		  </div>
		</div>

		<div class="col-md-4"> 
			<div class="card shadow-sm mb-1 bg-light p-4">
				<h3 class="summary-title">Order Summary</h3><!-- End .summary-title -->

				<table class="table table-summary">
					<tbody>
						@php
						$totalQuantity = \App\Models\Cart::where('user_id', Auth::id())->sum('product_quantity');
						@endphp
						<tr class="summary-subtotal">
							<td style="font-size:12px">Subtotal({{$totalQuantity}} items and shipping fee included)</td>
							<td id="cart-total">&#2547 {{ number_format($grand_total, 2) }}</td>
						</tr><!-- End .summary-subtotal -->
						 
						 <tr class="summary-total">
							<td>Total</td>
							<td id="cart-total">&#2547 {{ number_format($grand_total, 2) }}</td>
						</tr><!-- End .summary-total -->
					</tbody>
				</table><!-- End .table table-summary -->
			</div>
		</div>
	</div>

</div><!-- End .container -->
</div><!-- End .checkout -->
</div><!-- End .page-content -->
</main><!-- End .main -->

@include('front.inc.mollaFooter')