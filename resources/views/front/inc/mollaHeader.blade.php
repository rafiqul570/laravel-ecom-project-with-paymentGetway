
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ecommerce</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png"> -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png"> -->
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{asset('assets/images/icons/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.exzoom.css')}}" type="text/css">

    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}</script>
    
    <style>

    .payment-methods-list .payment-method-item {
        background-color: #f8f9fa;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s ease-in-out;
    }
    .payment-methods-list .payment-method-item:hover {
        background-color: #e9ecef;
    }
    .payment-methods-list .form-check-input {
        float: none;
        margin-right: 0.75rem;
    }
    .payment-methods-list .form-check-label {
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
    }
    .card-title {
        color: #333;
    }
    .summary-title {
        color: #333;
    }
    .table-summary td {
        border-top: none;
    }
    .table-summary .summary-total td {
        border-top: 1px solid #dee2e6;
        font-size: 1.1rem;
    }
    .btn-order {
        padding: 0.75rem;
        font-weight: 600;
    }

    .payment-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    .payment-option input[type="radio"] {
        display: none;
    }
    .payment-option-label {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .payment-option-label:hover {
        border-color: #0d6efd;
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    .payment-option input[type="radio"]:checked + .payment-option-label {
        border-color: #0d6efd;
        background-color: #f8faff;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }
    .payment-option-icon {
        margin-right: 1rem;
        flex-shrink: 0;
    }
    .payment-option-icon img {
        height: 40px;
        width: auto;
        max-width: 60px;
    }
    .payment-option-content {
        line-height: 1.4;
    }
    
    .color-radio input[type="radio"] {
      display: none;
    }

    .color-radio label {
      border: 2px solid #ccc;
      border-radius: 6px;
      padding: 10px 20px;
      cursor: pointer;
      font-weight: 500;
      margin-right: 10px;
    }

    .color-radio input[type="radio"]:checked + label {
      border-color: #000;
      background-color: #f8f9fa;
    }

     .size-option {
      display: none;
    }

    .size-label {
      display: inline-block;
      width: 40px;
      height: 40px;
      line-height: 40px;
      text-align: center;
      border: 2px solid #ccc;
      border-radius: 6px;
      margin: 5px;
      cursor: pointer;
      user-select: none;
      transition: all 0.2s;
    }

    .size-option:checked + .size-label {
      color: black;
      border-color: red;
    }

     
  </style>

</head>

<body> 
<header class="header">
    <div class="header-top" style="background: #fff; color: #000;">
        <div class="container">
            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            <li><a href="wishlist.html"><i class="icon-heart-o"></i>Wishlist <span>(3)</span></a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            
                           
                            <li>
                            
                           </li>
                         
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
                
                <div class="header-dropdown" style="font-weight: 500;">
                @if(Auth::check())  
                {{ Auth::user()->name }}
                <div class="header-menu">
                    <ul>
                        <li><a href="{{route('pendingOrders')}}">Dashboard</a></li>
                        <li style="margin-left: 15px;">
                         <form method="POST" action="{{ route('logout') }}">
                          @csrf
                            <button type="submit">Logout</button>
                        </form>
                        </li>
                    </ul>
                    @else
                    <div class="header__top__right__auth">
                     <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                    </div>    
                 @endif
                </div><!-- End .header-menu -->
            </div><!-- End .header-dropdown -->
          </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header custom-header" style="margin-bottom: 20px; background:rgba(255, 193, 7, 1);">
        <div class="container">
            
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('home')}}" class="logo">
                    <span style="font-size: 24px; color:rgba(220, 53, 69, 1); font-weight:500;">MIMSHOP</span>
                    <!-- <img src="{{asset('assets/images/logo.png')}}" alt="Molla Logo" width="105" height="25"> -->
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        
                        <li>
                            <a href="{{route('product.shop')}}" class="">Shop</a>
                        </li>
                        
                        
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right" style="margin-right: 50px; gap: 20px;">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
                
                <!-- Cartcount -->
                <div style="color: #c96;">
                    <a href="{{route('cart')}}">
                        <i class="icon-shopping-cart" style="font-size: 30px; color: #c96;"></i>
                        <span id="cart-count" class="cart-count">0</span>

                    </a>
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->