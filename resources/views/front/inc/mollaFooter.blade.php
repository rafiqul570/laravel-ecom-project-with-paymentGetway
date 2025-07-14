        <footer class="footer">
        	<div class="footer-middle">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-sm-6 col-lg-3">
	            			<div class="widget widget-about">
	            				<img src="{{asset('assets/images/logo.png')}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
	            				<p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. </p>

	            				<div class="social-icons">
	            					<a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
	            					<a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
	            					<a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
	            					<a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
	            					<a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
	            				</div><!-- End .soial-icons -->
	            			</div><!-- End .widget about-widget -->
	            		</div><!-- End .col-sm-6 col-lg-3 -->

	            		<div class="col-sm-6 col-lg-3">
	            			<div class="widget">
	            				<h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
	            					<li><a href="about.html">About Molla</a></li>
	            					<li><a href="#">How to shop on Molla</a></li>
	            					<li><a href="#">FAQ</a></li>
	            					<li><a href="contact.html">Contact us</a></li>
	            					<li><a href="login.html">Log in</a></li>
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-6 col-lg-3 -->

	            		<div class="col-sm-6 col-lg-3">
	            			<div class="widget">
	            				<h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
	            					<li><a href="#">Payment Methods</a></li>
	            					<li><a href="#">Money-back guarantee!</a></li>
	            					<li><a href="#">Returns</a></li>
	            					<li><a href="#">Shipping</a></li>
	            					<li><a href="#">Terms and conditions</a></li>
	            					<li><a href="#">Privacy Policy</a></li>
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-6 col-lg-3 -->

	            		<div class="col-sm-6 col-lg-3">
	            			<div class="widget">
	            				<h4 class="widget-title">My Account</h4><!-- End .widget-title -->

	            				<ul class="widget-list">
	            					<li><a href="#">Sign In</a></li>
	            					<li><a href="cart.html">View Cart</a></li>
	            					<li><a href="#">My Wishlist</a></li>
	            					<li><a href="#">Track My Order</a></li>
	            					<li><a href="#">Help</a></li>
	            				</ul><!-- End .widget-list -->
	            			</div><!-- End .widget -->
	            		</div><!-- End .col-sm-6 col-lg-3 -->
	            	</div><!-- End .row -->
	            </div><!-- End .container -->
	        </div><!-- End .footer-middle -->

	        <div class="footer-bottom">
	        	<div class="container">
	        		<p class="footer-copyright">Copyright © 2019 Molla Store. All Rights Reserved.</p><!-- End .footer-copyright -->
	        		<figure class="footer-payments">
	        			<img src="{{asset('assets/images/payments.png')}}" alt="Payment methods" width="272" height="20">
	        		</figure><!-- End .footer-payments -->
	        	</div><!-- End .container -->
	        </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
   
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

   

    <!-- Plugins JS File -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/superfish.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.exzoom.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/nouislider.min.js')}}"></script>
    <script src="{{asset('assets/js/wNumb.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

   
   <!-- Quantity Update -->

    <script>
    	$(document).on('change', '.update-qty', function () {
        let itemId = $(this).data('id');
        let qty = $(this).val();

        $.ajax({
            url: "{{ route('cart.update') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: itemId,
                product_quantity: qty
            },
            success: function (res) {
                if (res.success) {
                    $('.item-total-' + itemId).text('$' + res.item_total);
                    $('#cart-total').text('$' + res.new_total);
                    $('#cart-shipping').text('$' + res.shipping);
                    $('#cart-grandtotal').text('$' + res.grand_total);
                }
            }
        });
    });

 </script>

 <!-- Ajax Link -->

 <script>
	$(document).on('click', '.ajax-link', function(e) {
    e.preventDefault(); // Stop the link from reloading the page

    let url = $(this).attr('href');

    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            $('#result').html(response);
        },
        error: function(xhr) {
            alert('Error: ' + xhr.statusText);
        }
    });
  });
</script>


<!-- Add To Cart count -->

<script>
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            type: 'GET',
            success: function(data) {
                $('#cart-count').text(data.count);
            },
            error: function(err) {
                console.log('Error fetching cart count', err);
            }
        });
    }

    // Call once on page load
    updateCartCount();

    // Then update every 10 seconds (adjust interval as needed)
    setInterval(updateCartCount, 1000);
</script>

<!-- PROCEED TO CHECKOUT (quantity count) -->
<script>
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            type: 'GET',
            success: function(data) {
                $('#cart-count2').text(data.count);
            },
            error: function(err) {
                console.log('Error fetching cart count', err);
            }
        });
    }

    // Call once on page load
    updateCartCount();

    // Then update every 10 seconds (adjust interval as needed)
    setInterval(updateCartCount, 1000);
</script>

 
 <!-- prevent page reload -->
<script>
$(document).on('click', '.product-link', function(e) {
    e.preventDefault(); // prevent page reload
    
    var id = $(this).data('id');
    var slug = $(this).data('slug');

    $.ajax({
        url: '/products/' + id + '/' + slug, // Your route pattern
        type: 'GET',
        success: function(response) {
            $('#product-details').html(response); // Load the response into the div
        },
        error: function(xhr) {
            console.log('Error:', xhr);
        }
    });
});
</script>


<!-- color and related product -->

<script>
function selectColor(colorName) {
    // Set radio button value
    const radio = document.getElementById('color-radio');
    radio.value = colorName;
    radio.checked = true;

    // Update label text
    const label = document.getElementById('color-label');
    label.textContent = colorName;
}
</script>

  
</body>
</html>
