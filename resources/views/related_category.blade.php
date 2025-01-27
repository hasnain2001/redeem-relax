<?php
header("X-Robots-Tag:index, follow");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{!! $category->title !!}</title>
    <link rel="canonical" href="https://couponsarena.com/category/{{ Str::slug($category->title) }}">

    <!-- Your custom meta tags go here -->
    <meta name="description" content="{!! $category->meta_description !!}">
    <meta name="keywords" content="{!! $category->meta_keyword !!}">


<link rel="stylesheet" href="{{ asset('cssfile/related-category.css') }}">


  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

     <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
 <style>
    /* Category Header Style */
.category-header {
    background-size: contain;
    background-position:cover ;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;

    background-image: url('{{ asset('uploads/categories/' . $category->category_image) }}');
   
}

.category-header .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 15px;
}

.category-header .category-title {
    font-size: 3rem;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    border-radius: 5%;
}

/* Fallback Image Style */
.fallback-image {
    height: 300px;
    background-color: #f8f9fa;
    border-radius: 10px;
}

.fallback-image i {
    color: #6c757d;
}

.fallback-image p {
    color: #6c757d;
}

 </style>
  </head>
  <body>

    <!-- navbar ! -->

   @include('components.navbar')



<!-- End navbar! -->

<div class="container">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">Home</a>
            </li>
<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">{{$category->title}}</li>
        </ol>
    </nav>
    <div class="category-header text-center text-white" >
        @if ($category->category_image)
            <div class="overlay d-flex justify-content-center align-items-center">
                <h1 class="category-title text-uppercase ">{{ $category->title }}</h1>
            </div>
        @else
            <div class="d-flex align-items-center justify-content-center mt-3 fallback-image">
                <i class="fas fa-image fa-3x text-muted"></i>
                <p class="ms-2 mb-0 text-muted">No image available</p>
            </div>
        @endif
    </div>
    
    
    

    <p class="h5 m-0">Total stores: <span class="fw-bold">{{ $stores->count() }}</span></p>

        <div class="row card-list g-4">
            @forelse ($stores as $store)
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
@php
    $language = $store->language ? $store->language->code : 'en'; // Default to 'en' if language is null
    $storeSlug = Str::slug($store->slug);

    // Conditionally generate the URL based on the language
    $storeurl = $store->slug
        ? ($language === 'en'
            ? route('store_details', ['slug' => $storeSlug])  // English route without 'lang'
            : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))  // Other languages
        : '#';
@endphp


                
                <a href="{{ $storeurl }}" class="card-link text-decoration-none">

                    <div class="shadow-bg h-100">
                        <div class="card-body ">
                            <div class="card">
                            <img class="card" src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}" loading="lazy" alt="Card Image"></div>
                            <h5 class="card-title mt-3">{{ $store->name ?: "Title not found" }}</h5>
                        </div>
                    </div>

                                          </a>
                
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        No Stores found  in category!!!
                    </div>
                </div>
            @endforelse
        </div>
    </div>

   @include('components.footer')

  </body>
</html>
