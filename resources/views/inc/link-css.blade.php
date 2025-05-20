<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ecommerce</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
    }

    /* Top Bar */
    .top-bar {
      background-color: #f8f9fa;
      font-size: 14px;
    }

    .top-bar a {
      color: #333;
      margin-left: 15px;
      text-decoration: none;
    }

    /* Header */
    .header {
      background-color: #fff;
      padding: 15px 0;
      border-bottom: 1px solid #ddd;
    }

    .search-input {
      border-radius: 0;
    }

    /* Dropdown + Category */
    .category-wrapper {
      position: relative;
    }

    .category-trigger {
      background: ;
      padding: 5px;
      cursor: pointer;
    }

    .category-menu {
      position: absolute;
      top: 100%;
      left: 0;
      width: 250px;
      background: #fff;
      border: 1px solid #ddd;
      display: none;
      z-index: 999;
    }

    .category-wrapper:hover .category-menu {
      display: block;
    }

    .category-menu li {
      padding: 10px 15px;
      border-bottom: 1px solid #eee;
      position: relative;
      cursor: pointer;
    }

    .category-menu li:hover {
      background-color: #f0f0f0;
    }

    .sub-category-menu {
      position: absolute;
      top: 0;
      left: 250px;
      width: 250px;
      background: #fff;
      border: 1px solid #ddd;
      display: none;
      z-index: 1000;
    }

    .category-menu li:hover .sub-category-menu {
      display: block;
    }

    .sub-category-item {
      padding: 10px 15px;
      border-bottom: 1px solid #eee;
      position: relative;
    }

    .sub-category-item:hover {
      background-color: #f9f9f9;
    }

    .product-menu {
      position: absolute;
      top: 0;
      left: 250px;
      width: 250px;
      background: #fff;
      border: 1px solid #ddd;
      display: none;
      z-index: 1001;
    }

    .sub-category-item:hover .product-menu {
      display: block;
    }

    .product-menu a {
      display: block;
      padding: 8px 15px;
      text-decoration: none;
      color: #333;
      border-bottom: 1px solid #eee;
    }

    .product-menu a:hover {
      background-color: #f0f0f0;
      text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .top-bar {
        font-size: 12px;
        text-align: center;
        padding: 5px;
      }

      .top-bar a {
        display: inline-block;
        margin: 5px 10px;
      }

      .header .row {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
      }

      .header .col-md-2,
      .header .col-md-8,
      .header .col-md-2.text-end {
        width: 100%;
        margin-bottom: 10px;
      }

      .header form {
        flex-direction: column;
        align-items: stretch;
      }

      .header select,
      .header input,
      .header button {
        width: 100% !important;
        margin-bottom: 10px;
      }

      .category-trigger {
        width: 100%;
        text-align: center;
        font-size: 16px;
        background-color: #ff5722;
        color: #fff;
        border-radius: 5px;
      }

      .category-wrapper {
        width: 100%;
      }

      .category-menu,
      .sub-category-menu,
      .product-menu {
        position: relative;
        width: 100%;
        left: 0;
        top: 0;
        border: none;
        box-shadow: none;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      .category-wrapper.active .category-menu {
        max-height: 1000px;
      }

      .category-menu li,
      .sub-category-item,
      .product-menu a {
        padding: 10px;
        font-size: 14px;
      }

      .product-menu,
      .sub-category-menu {
        display: none !important;
      }

      .category-trigger::after {
        content: ' ▼';
        float: right;
      }
    }

    @media (max-width: 768px) {
      #nav-link{

        padding-left: 5px;
        
        }
      }
  </style>
</head>