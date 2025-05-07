// Image Zoom

    $(function(){

      $("#exzoom").exzoom({

        // thumbnail nav options
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,

        // autoplay
        "autoPlay": false,

        // autoplay interval in milliseconds
        "autoPlayTimeout": 2000
        
      });

    });


//Product Size
 
    const radios = document.querySelectorAll('input[name="size"]');
    const output = document.getElementById('selectedSize');

    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        output.textContent = "Selected Size: " + radio.value;
      });
    });


//Quantity Uptate ajax 

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


//Ajax Link

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
