<!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- JS Toggle for Mobile Menu -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const trigger = document.querySelector('.category-trigger');
      if (trigger) {
        trigger.addEventListener('click', function () {
          this.parentElement.classList.toggle('active');
        });
      }
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


<!-- Search Product -->
 <script>
  $(document).ready(function () {
    $('#searchBtn').on('click', function () {
      const search = $('#searchInputHome').val().trim();
      if (search !== '') {
        window.location.href = '/product/shop?search=' + encodeURIComponent(search);
      }
    });

    // Optional: Enter key press
    $('#searchInputHome').on('keypress', function (e) {
      if (e.which === 13) {
        $('#searchBtn').click();
      }
    });
  });
</script>

</body>
</html>