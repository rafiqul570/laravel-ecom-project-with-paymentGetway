@include('front.inc.mollaHeader')

<main class="main">
 <nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="container">
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
	        <li class="breadcrumb-item"><a href="#">Product Details</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
	    </ol>
	</div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
<div class="cart">
<div class="container">
	<div class="row">
		<div class="col-lg-9 summary summary-cart">
			<table class="table table-cart table-mobile">
				<thead>
					<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th class="text-center">Remove</th>
					</tr>
				</thead>

				<tbody>

                    @foreach($cartItems as $item)

                    @php 
                        // It's better to use the relationship if you already loaded it in the controller
                        // But keeping your original logic for finding the image
                        $productImage = App\Models\Product::where('id', $item->product_id)->value('product_img'); 
                    @endphp
					<tr>
    					<td class="product-col">
    						<div class="product">
    							<figure class="product-media">
    								<img src="{{asset('/uploads/image/'.$productImage)}}" width="40" alt="Product image">
    							</figure>

    							<h3 class="product-title">
    								{{$item->product_name}}
    							</h3><!-- End .product-title -->
    						</div><!-- End .product -->
    					</td>
    					
                        {{-- This part correctly shows the unit price --}}
    					@if($item->discount_price > 0)
    					    <td class="price-col">৳ {{number_format($item->discount_price, 2) }}</td>
    					@else
    					    <td class="price-col">৳ {{number_format($item->product_price, 2) }}</td>
    					@endif
    					
    					<td class="quantity-col">
    	                    <div class="cart-product-quantity">
    	                        <input type="number" class="form-control update-qty" data-id="{{ $item->id }}" value="{{ $item->product_quantity }}" min="1" step="1" data-decimals="0" required>
    	                    </div>
    	                </td>
	           
                        {{-- ***** FIX STARTS HERE ***** --}}
                        {{-- Calculate the item total based on the correct price (discounted or regular) --}}
                        @php
                            $effectivePrice = $item->discount_price > 0 ? $item->discount_price : $item->product_price;
                            $itemTotal = $effectivePrice * $item->product_quantity;
                        @endphp
                        <td class="total-col item-total-{{ $item->id }}">৳ {{ number_format($itemTotal, 2) }}</td>
                        {{-- ***** FIX ENDS HERE ***** --}}
				
				        <td class="remove-col">
				            <a onclick="return confirm('Are you sure you want to remove this item?')" href="{{route('cart.delete', $item->id)}}" class="btn-remove"><i class="icon-close"></i></a>
				        </td>
				
				    </tr>
                    @endforeach
			    </tbody>
			</table><!-- End .table table-wishlist -->

			<div class="cart-bottom">
    			<div class="cart-discount">
    				<form action="#" method="POST">
    					<div class="input-group">
    						<input type="text" class="form-control" required placeholder="coupon code">
    						<div class="input-group-append">
								<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
							</div><!-- .End .input-group-append -->
						</div><!-- End .input-group -->
    				</form>
    			</div><!-- End .cart-discount -->
			</div><!-- End .cart-bottom -->
		</div><!-- End .col-lg-9 -->
		
		<aside class="col-lg-3">
			<div class="summary summary-cart">
				<h3 class="summary-title">Order Summary</h3><!-- End .summary-title -->

				<table class="table table-summary">
					<tbody>
						<tr class="summary-subtotal">
							<td>Subtotal</td>
                            {{-- This $total variable comes from the controller and is already calculated correctly --}}
							<td id="cart-total">৳ {{ number_format($total, 2) }}</td>
						</tr><!-- End .summary-subtotal -->
					
						<tr class="summary-shipping-row">
							<td>Shipping Fee</td>
							<td><span id="shipping-cost">৳ {{ number_format($shippingCost, 2) }}</span></td>
						  </tr><!-- End .summary-shipping-row -->
					
						 <tr class="summary-total">
							<td>Total</td>
                            {{-- This $grand_total variable comes from the controller and is also correct --}}
							<td><strong id="cart-grandtotal">৳ {{ number_format( $grand_total, 2) }}</strong></td>
						</tr><!-- End .summary-total -->
					</tbody>
				</table><!-- End .table table-summary -->
				@if($total <= 0)
				    <a href="{{route('billing')}}" class="btn btn-outline-primary-2 btn-order btn-block disabled">PROCEED TO CHECKOUT(<span id="cart-count2">0</span>)</a>
				@else
				    <a href="{{route('billing')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT(<span id="cart-count2">{{ $cartItems->sum('product_quantity') }}</span>)</a>
				@endif
			</div><!-- End .summary -->

			<a href="{{ url('/') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
		</aside><!-- End .col-lg-3 -->
	</div><!-- End .row -->
</div><!-- End .container -->
</div><!-- End .cart -->
</div><!-- End .page-content -->
</main><!-- End .main -->

@include('front.inc.mollaFooter')