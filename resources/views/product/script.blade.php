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


<!-- search -->
<script>
  $(document).ready(function () {
    // Get search from URL (e.g., ?search=laptop)
    const urlParams = new URLSearchParams(window.location.search);
    const searchFromURL = urlParams.get('search') || '';
    $('#searchInput').val(searchFromURL);

    fetchProducts(); // Initial load with search from URL

    $('#searchInput').on('keyup', fetchProducts);
    $('.accordion-body input[type="checkbox"]').on('change', fetchProducts);

    function getCheckedValues(selector) {
      return $(selector + ' input:checked').map(function () {
        return this.value;
      }).get();
    }

    function fetchProducts() {
      let data = {
        search: $('#searchInput').val(),
        category_name: getCheckedValues('#filterCategory'),
        subCategory_name: getCheckedValues('#filterSubCategory'),
        brand_name: getCheckedValues('#filterBrand'),
        color_name: getCheckedValues('#filterColor'),
        size_name: getCheckedValues('#filterSize'),
        product_price: getCheckedValues('#filterPrice'),
      };

      $.ajax({
        url: '/filter-products',
        type: 'GET',
        data: data,
        success: function (products) {
          let html = '';
          if (products.length === 0) {
            html = '<div class="text-center text-danger mt-5"><h1>No products found.</h1></div>';
          } else {
            products.forEach(product => {
              html += `
                <div class="col-md-2 product-card shadow-sm m-3 text-center">
                  <a href="/products/${product.id}/${product.slug}" class="text-decoration-none text-dark">
                    <img src="/uploads/image/${product.product_img}" class="img-fluid mb-2" alt="${product.name}">
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
    }
  });
</script>





<!-- <script>
  $(document).ready(function () {
    $('.ajax-category').on('click', function () {
      let id = $(this).data('id');
      let type = $(this).data('type');

      $.ajax({
        url: "/ajax-fetch-products",
        method: "GET",
        data: {
          id: id,
          type: type
        },
        success: function (response) {
          $('#productContent').html(response.html);
        },
        error: function () {
          alert('Something went wrong.');
        }
      });
    });
  });
</script> -->


</body>
</html>

