<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <title>ECOMMERCE</title>

    <!-- Summernote CSS -->
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- vendor css -->
    <link href="{{asset('backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/medium-editor/medium-editor.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/medium-editor/default.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">

    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/starlight.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/header.css')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>

  <body>

  <!-- ########## START: LEFT PANEL ########## -->

    <div class="sl-logo pl-5"><span class="text-uppercase logged-name text-light mr-3"><img src="{{asset('frontend/img/logo2.png')}}" alt=""></span></div>
    <div class="sl-sideleft">
      <div class="sl-sideleft-menu">
        <a href="{{route('redirects')}}" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
         
         <?php
        $role = Auth::user()->role;
        if($role == '1'){
        ?>

         <a href="{{route('home')}}" target="_blank" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Visite Site</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.category.create')}}" class="nav-link">Add Category</a></li>
          <li class="nav-item"><a href="{{route('admin.category.index')}}" class="nav-link">All Category</a></li>
        </ul>

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Color</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.color.create')}}" class="nav-link">Add Color</a></li>
          <li class="nav-item"><a href="{{route('admin.color.index')}}" class="nav-link">All Color</a></li>
        </ul>

        <!-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Size</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.size.create')}}" class="nav-link">Add Size</a></li>
          <li class="nav-item"><a href="{{route('admin.size.index')}}" class="nav-link">All size</a></li>
        </ul> -->

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Shipping Cost</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.shippingcost.create')}}" class="nav-link">Add Shippingcost</a></li>
          <li class="nav-item"><a href="{{route('admin.shippingcost.index')}}" class="nav-link">All Shippingcost</a></li>
        </ul>
        

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Product</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.product.create')}}" class="nav-link">Add Product</a></li>
          <li class="nav-item"><a href="{{route('admin.product.index')}}" class="nav-link">All Product</a></li>
        </ul>

        <a href="{{route('admin.orderDelivered')}}" class="sl-menu-link">
          <div class="sl-menu-item">
            <span class="menu-item-label">Order</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

      
      <?php } ?>

      </div><!-- sl-sideleft-menu -->
      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
     <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <!-- <span class="text-uppercase logged-name text-light mr-3">{{ Auth::user()->name }}</span> -->
      <div class="sl-header-right" style="margin-right: 40px;">
        <nav class="nav">
          <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-light-700 focus:outline-none transition ease-in-out duration-150">
                            <div style="color: white;">{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                          @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </nav>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
 


