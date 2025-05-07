
@include('front.inc.mollaHeader')
<main class="main">
<nav aria-label="breadcrumb" class="breadcrumb-nav">
<div class="container">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('front.cart.index')}}">Add-To-Cart</a></li>
    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
</ol>
</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
<div class="checkout">
<div class="container">
	<div class="checkout-discount">
		<!-- <form action="#">
			<input type="text" class="form-control" required id="checkout-discount-input">
			<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
		</form> -->
	</div><!-- End .checkout-discount -->
	<form action="{{route('front.checkout.store')}}" method="POST">
		@csrf
    	<div class="row">
    		<div class="col-lg-8">
    			<div class="summary">
    			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
					
					<div class="col-sm-12">
						<label>City/Village *</label>
						<input type="text" class="form-control" name="city" required>
					</div><!-- End .col-sm-6 -->

					<div class="col-sm-12">
						<label>Postcode / ZIP *</label>
						<input type="text" class="form-control" name="postcode" required>
					</div><!-- End .col-sm-6 -->

					<div class="col-sm-12">
						<label>Phone number *</label>
						<input type="tel" class="form-control" name="phone" required>
					</div>
    		</div><!-- End .col-lg-8 -->
    		</div>
    		<aside class="col-lg-4">
    			<div class="summary">
    				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

    				<table class="table table-summary">
    					<thead>
    						<tr>
    							<th>Product</th>
    							<th>Total</th>
    						</tr>
    					</thead>

    					<tbody>
    						 
    						@foreach($cartItems as $item)
    						<tr>
    							<td><a href="#">{{$item -> product_name}}</a></td>
    							
    							<td>&#2547 {{ number_format($item->product_price * $item->product_quantity, 2) }}</td>
    						</tr>
    						@endforeach
    						<tr class="summary-total">
    							
    							<td>Subtotal:</td>
    							<td>&#2547 {{ number_format($subtotal, 2) }}</td>
    						</tr><!-- End .summary-subtotal -->
    						<tr>
    							<td>Shipping:</td>
    							<td>&#2547 {{ number_format($shippingCost, 2) }}</td>
    						</tr>
    						<tr class="summary-total">
    							<td>Total:</td>
    							<td><strong>&#2547 {{ number_format($total, 2) }}</strong></td>
    						</tr><!-- End .summary-total -->
    						
    					</tbody>
    				</table><!-- End .table table-summary -->

    				<div class="accordion-summary" id="accordion-payment">
    				<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
    					<span class="btn-text">Place Order</span>
    					<span class="btn-hover-text">Proceed to Checkout (<span id="cart-count2">0</span>)</span>
    				</button>
    			</div><!-- End .summary -->
    		</aside><!-- End .col-lg-3 -->
    	</div><!-- End .row -->
	</form>
</div><!-- End .container -->
</div><!-- End .checkout -->
</div><!-- End .page-content -->
</main><!-- End .main -->

@include('front.inc.mollaFooter')