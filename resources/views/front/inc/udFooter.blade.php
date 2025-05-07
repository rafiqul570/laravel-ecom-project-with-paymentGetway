<!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
    <!-- Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    
  <script>
    const toggleBtn = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("active");
      overlay.classList.toggle("active");
    });

    overlay.addEventListener("click", () => {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });
  </script>

   
   <!-- Quantity Update -->

    <script>
      $(document).on('change', '.update-qty', function () {
        let itemId = $(this).data('id');
        let qty = $(this).val();

        $.ajax({
            url: "{{ route('front.cart.update') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: itemId,
                quantity: qty
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
            url: "{{ route('front.cart.count') }}",
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
            url: "{{ route('front.cart.count') }}",
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
        url: '/front.pages.singleProduct/' + id + '/' + slug, // Your route pattern
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
</body>
</html>