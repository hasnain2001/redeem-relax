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
        <h1>Shopping Hacks & Savings Tips & Tricks</h1>
        <div class="col-md-8">
            
            <!-- Blog posts -->
            <div class="row">
                @foreach ($blogs as $blog)
                @if ($blog->slug)
           <a href="{{ route('blog-details', ['slug' => Str::slug($blog->slug)]) }}" class="col-md-12 mb-4">


                    @else
                    <a href="javascript:;" class="btn btn-darkcol-md-12 mb-4 text-decoration-none">no Slug</a>
                        @endif
                        <div class="blog-post">
                            <img src="{{ asset($blog->category_image) }}" alt="Blog Post Image" style="width: 1000px; height: 400px;">
                            <div class="post-content">
                                <h2>{{ $blog->title }}</h2>

                                <!-- Add more fields as needed -->
                            </div>
                        </div>
                    </a>
                    @endforeach
            </div>
             <div class="container bg-light mt-3">
          <div class="row mt-3 justify-content-end">
            <div class="col-12">
              {{ $blogs->links('pagination::bootstrap-4') }} </div>
          </div>
        </div>

        </div>

     <div class="col-md-4">
      <aside class="sidebar p-3 bg-light">
        <!-- Sidebar Title -->
        <h2 class="bold text-dark mb-3">Top Stores</h2>
        <!-- Store Listings -->
        <div class="row gx-2 gy-2">
          @foreach ($chunks as $store)
            <div class="col-md-6 col-sm-4 col-6">
                @php

                $storeurl = $store->slug
                ? route('store_details', ['slug' => Str::slug($store->slug)])
                : '#';
                @endphp
              <a href="{{$storeurl}}" class="text-dark text-decoration-none d-flex flex-column p-2">
                <!-- Store Image -->
                <img src="{{ asset('uploads/store/' . $store->store_image) }}" alt="{{ $store->name }}" class="mb-2  shadow" style="width: 100px; height: 100px; object-fit: cover;">
                <!-- Store Name -->
                <p class="text-capitalize">{{ $store->name }}</p>
              </a>
            </div>
          @endforeach
        </div>
      </aside>
    </div>
    </div>
</div>

 
  <x-alert/>



</body>
</html>
