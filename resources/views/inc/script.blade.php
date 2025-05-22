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

<!-- Product display by category -->
<script>
  $('.category-link').on('click', function (e) {
  e.preventDefault();

  const categoryId = $(this).data('id');
  const categorySlug = $(this).data('slug');

  $.ajax({
    url: '/filter-products',
    type: 'GET',
    data: {
      category_id: categoryId,
      category_slug: categorySlug
    },
    success: function (products) {
      let html = '';
      if (products.length === 0) {
        html = '<div class="text-center text-danger mt-5"><h1>No products found.</h1></div>';
      } else {
        products.forEach(product => {
          html += `
            <div class="col-md-2 product-card shadow-sm m-3 text-center">
              <a href="/products/${product.id}/${product.slug}" class="text-decoration-none text-dark">
                <img src="/uploads/image/${product.product_img}" class="img-fluid mb-2" alt="${product.product_name}">
                <h5>${product.product_name}</h5>
                <p>$ ${product.product_price}</p>
              </a>
            </div>
          `;
        });
      }
      $('#productList').html(html);
    }
  });
});

</script>



<!-- JavaScript for Click + Redirect -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInputHome");

    document.querySelectorAll(".category-link").forEach(function (link) {
      link.addEventListener("click", function () {
        const slug = this.getAttribute("data-slug");
        const id = this.getAttribute("data-id");

        // Set the slug into the visible search input
        searchInput.value = slug;

        // Optional: Trigger the click on search button (or redirect directly)
        window.location.href = `/front/pages/categoryPage/${id}/${slug}`;
      });
    });
  });
</script>



</body>
</html>