
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
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.exzoom.css')}}" type="text/css">
    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <style>
    
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
    <div class="header-top" style="background: #c96; color: #000;">
        <div class="container">
            <div class="header-left"> 
                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->

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
                
                <div class="header-dropdown">
                @if(Auth::check())  
                {{ Auth::user()->name }}
                <div class="header-menu">
                    <ul>
                        <li><a href="{{route('front.pages.pendingOrders')}}">Dashboard</a></li>
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

    <div class="header-middle sticky-header" style="border-bottom: 1px solid #c96; margin-bottom: 20px;">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('home')}}" class="logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            <a href="{{route('home')}}" class="">Home</a>

                        </li>
                        
                        <li>
                            <a href="category.html" class="">Shop</a>


                        </li>
                        <li>
                            <a href="product.html" class="">Cart</a>

                        </li>
                        <li>
                            <a href="#" class="">Checkout</a>

                        </li>
                        <li>
                            <a href="blog.html" class="">Blog</a>

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
                    <a href="{{route('front.cart.index')}}">
                        <i class="icon-shopping-cart" style="font-size: 30px; color: #c96;"></i>
                        <span id="cart-count" class="cart-count">0</span>

                    </a>
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->