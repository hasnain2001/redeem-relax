<?php
header("X-Robots-Tag:index, follow");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Honeycomb Deals - Best Deals and Discounts | Honeycomb Deals</title>
    <!-- Your custom meta tags go here -->
     <meta name="description" content="Find the best deals, discounts, and coupons on Honeycomb Deals. Save money on your favorite products from top brands.">

 <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing">

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

<link rel="canonical" href="https://honeycombdeals.com/categories">

    <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">

<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('front/assets/css/home.css')}}">

        <style>
            .categoriees{
                text-decoration: none;
                color: black;
            }
            .categoriees:hover{
                text-decoration: none;
                color: black
            }
        </style>
</head>
<body>

  <x-navbar/>

<main>
    <div class="main_content">
      <div class="container">
        <div class="row mt-3">
          <h1 class="text-center text-capitalize display-4 mb-4">our categories</h1>
  
          <!-- Grid layout to show 2 categories per row on mobile, 2 on small screens, 3 on medium, and 4 on large screens -->
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($category as $category)
              <div class="col">
                <div class="card shadow-sm h-100 overflow-hidden">
                  <a href="{{ route('related_category', ['title' => Str::slug($category->title)]) }}">
                    @if ($category->category_image)
                      <img src="{{ asset('uploads/categories/' . $category->category_image) }}" class="card-img-top" alt="{{ $category->title }} Image" loading="lazy">
                    @else
                      <div class="d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <p class="ms-2 mb-0 text-muted">No image available</p>
                      </div>
                    @endif
                  </a>
                  <div class="card-body d-flex flex-column justify-content-between">
                    <a href="{{ route('related_category', ['title' => Str::slug($category->title)]) }}" class="categoriees">
                      <h5 class="card-title text-capitalize text-center">{{ $category->title }}</h5>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </main>
  

    <x-alert/>


</body>
</html>
