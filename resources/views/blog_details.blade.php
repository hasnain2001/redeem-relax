<?php
header("X-Robots-Tag:index, follow");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">

 

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

@if(isset($blog) && is_object($blog))
   <!-- Your custom meta tags go here -->
   <title>{!! $blog->meta_title !!}</title>
    <link rel="canonical" href="{{ url()->current() }}">
        <meta name="description" content="{!! $blog->meta_description !!}">

 <meta name="keywords" content="{!! $blog->meta_keyword !!}">
@else
    <!-- Handle the case where $store is not valid -->
    <!-- You can display a default canonical URL or handle it in another appropriate way -->
    <link rel="canonical" href="https://honeycombdeals.com">
@endif

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('front/assets/css/blogdetail.css') }}">

<style>
    .blog-title {
        font-size: 22px;
        color: #6c757d;
        font-weight: 400;
font-family: 'Poppins', sans-serif;       
    }
</style>
</head>
<body>



<x-navbar/>
<br>
<nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
    <ol class="breadcrumb mb-0">

            <li class="breadcrumb-item">
                <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('message.home')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/blog') }}" class="text-decoration-none text-primary" style="font-weight: 500;">Blog</a>
                    </li>
            

<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">{{ $blog->title }}</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 mb-4">
            <div class="blog-post card shadow rounded-lg border border-light">
                <img class="img-fluid" src="{{ asset($blog->category_image) }}" alt="Blog Image" style="width: 100%; height: auto;">
                <div class="card-body">
                  <ul>
                    <li>  <h1 class="blog-title  mb-4">{{ $blog->title }}</h1></li>
                  </ul>
                    <p class="card-text text-gray-700 text-lg leading-relaxed">{!! $blog->content !!}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 order-md-last">
            <aside class="sidebar p-3 bg-light">
                <h2 class="bold text-dark mb-3">Top Stores</h2>
                <div class="row gx-2 gy-2">
                    @foreach ($chunks as $store)
                        <div class="col-6 col-md-12 col-sm-6 col-lg-6">
                            @php

                            $storeurl = $store->slug
                            ? route('store_details', ['slug' => Str::slug($store->slug)])
                            : '#';
                            @endphp
                            <a href="{{ $storeurl }}" class="text-dark text-decoration-none d-flex flex-column p-2 align-items-center">
                                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}" class="mb-2 shadow" style="width: 100px; height: 100px; object-fit: cover;">
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
