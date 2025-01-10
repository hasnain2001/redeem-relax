<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Honeycomb Deals Blog - Smart Shopping Tips & Tricks</title>

    <!-- Your custom meta tags go here -->
     <meta name="description" content="Find the best deals, discounts, and coupons on Honeycomb Deals. Save money on your favorite products from top brands.">

 <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing">

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

<link rel="canonical" href="https://honeycombdeals.com/blog">


   <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">


    <link rel="stylesheet" href="{{ asset('front/assets/css/blog.css') }}">
  

</head>
<body>
<x-navbar/>
<br>

<div class="container">
  <div class="row">
    
      <!-- Blogs Section -->
      <div class="col-md-9">
          <h1>Shopping Hacks & Savings Tips & Tricks</h1>
          <div class="row">
              @foreach ($blogs as $blog)
              @php
              $blogurl = $blog->slug
                  ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                  : '#';
              @endphp
              <div class="col-md-4 mb-4">
                  <div class="card h-100 shadow-sm">
                      <img src="{{ asset($blog->category_image) }}" class="card-img-top" alt="Blog Post Image">
                      <div class="card-body">
                          <h5 class="card-title">{{ $blog->title }}</h5>
                          <p class="card-text">{{ Str::limit($blog->description, 100, '...') }}</p>
                          <a href="{{ $blogurl }}" class="btn btn-dark rounded-pill">Read More</a>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
        <!-- Stores Section -->
        <div class="col-md-3">
          <aside class="sidebar p-3 bg-light">
              <!-- Sidebar Title -->
              <h2 class="bold text-dark mb-3">Top Stores</h2>
              <!-- Store Listings -->
              <div class="row gx-2 gy-2">
                  @foreach ($chunks as $store)
                  <div class="col-12 mb-3">
                      @php
                      $storeurl = $store->slug
                          ? route('store_details', ['slug' => Str::slug($store->slug)])
                          : '#';
                      @endphp
                      <a href="{{ $storeurl }}" class="text-dark text-decoration-none d-flex align-items-center">
                          <!-- Store Image -->
                          <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}" class="me-2 shadow" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                          <!-- Store Name -->
                          <p class="text-capitalize mb-0">{{ $store->name }}</p>
                      </a>
                  </div>
                  @endforeach
              </div>
          </aside>
      </div>

  </div>
</div>


 
  <x-footer/>



</body>
</html>
