
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MIMSHOP</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}">

</head>

<body>
  
  <!-- Top Bar -->
  <div class="top-bar py-2 text-end px-4">
    <a href="#">Save More on App</a>
    <a style="font-weight: bold; color:red" href="{{route('product.shop')}}">Shop</a>
    <a href="#">Help & Support</a>
    <a href="{{ route('register') }}">Signup</a>
    <a href="{{route('cart')}}"><i class="bi bi-cart3 text-warning" style="font-size: 20px; color: #000;"></i><span id="cart-count" class="text-dark"> 0</span></a>
  </div>
  
 <!-- Responsive Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning shadow-sm py-2">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand fw-bold text-danger fs-4 p-3" href="{{route('home')}}">MIMSHOP</a>

    <!-- Toggler button for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="mainNavbar">

      <!-- Search -->
      <input type="text" class="form-control me-2" id="searchInputHome"   autocomplete="off" placeholder="Search products...">
      <input type="hidden" id="searchInput" oninput="storeSearchQuery()" class="form-control mb-3" placeholder="Search products...">
      
      <button class="btn btn-danger" id="searchBtn"><i class="bi bi-search"></i></button>

      <!-- Right:Cart -->
      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>


        <li class="nav-item" style="margin-left: 10px;">
          
         <div class="header-dropdown dropdown">
           @if(Auth::check())
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('pendingOrders') }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul> 
            @else
                <a class="nav-link fs-6" href="{{ route('login') }}" class="nav-link"><i class="fa fa-user"></i> Login</a>
            @endif
         </div>
        </li>

      </ul>
    </div>
  </div>
</nav>


<!-- Navigation + Category -->
<div class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <div class="category-wrapper">
      <div class="category-trigger fw-bold text-dark">All Categories</div>
      <ul class="category-menu list-unstyled mb-0" id="dropdownCategory">
        @if($categories->isEmpty())
        
        <p>Data Not Found....</p>
        
        @else
         
         @foreach($categories as $category)
        <li>
          
          <a class="nav-link" href="{{route('front.pages.categoryPage',[$category->id, $category->slug] )}}">{{$category->category_name}}
          </a>

          <ul class="sub-category-menu list-unstyled mb-0">
           @foreach($category->subCategories as $sub)
           <li class="sub-category-item">
            
            <a class="nav-link" href="{{route('front.pages.subCategoryPage',[$sub->id, $sub->slug] )}}">{{$sub->subCategory_name}}
            </a>
          
          </li>
          @endforeach
        </ul>
      </li> 
      @endforeach
     @endif
    </ul>
  </div>
 </div>
</div> 



