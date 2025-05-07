<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.exzoom.css')}}" type="text/css">
    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
    <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .dashboard-wrapper {
      display: flex;
      flex-grow: 1;
    }
    .sidebar {
      min-height: 100vh;
      background-color: #343a40;
    }
    .sidebar .nav-link {
      color: #ffffff;
    }
    .sidebar .nav-link:hover {
      background-color: #495057;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        z-index: 1050;
        width: 250px;
        left: -250px;
        transition: left 0.3s;
      }

      .sidebar.active {
        left: 0;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
      }

      .overlay.active {
        display: block;
      }
    }
  </style>
</head>
<body>

  <!-- Toggle Button -->
  <nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
      <button class="btn btn-outline-light" id="menu-toggle"><i class="fas fa-bars"></i></button>
      <span class="navbar-brand">Dashboard</span>
    </div>
  </nav>

  <!-- Overlay for mobile -->
  <div class="overlay" id="overlay"></div>

  <div class="dashboard-wrapper">
    <!-- Sidebar -->
    <div class="sidebar p-3 d-md-block" id="sidebar">
      <a href="{{route('home')}}">
        <h4 class="text-white my-4">User Panel</h4>
      </a>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{route('front.pages.pendingOrders')}}"><i class="fas fa-home me-2"></i>Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('front.pages.pendingOrders')}}"><i class="fas fa-box me-2"></i>Pending Orders</a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="{{route('front.pages.history')}}"><i class="fas fa-box me-2"></i>History</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-cog me-2"></i>Settings</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div style="margin-left: 10px;">
            <i style="color: white;" class="fas fa-sign-out-alt"></i>
              <input style="background: none; border:none; color: white;" type="submit" value="Logout">
            </div>
          </form>
        </li>
      </ul>
      
    </div>

    