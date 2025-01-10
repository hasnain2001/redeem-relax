<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




<title>{{ $category->meta_tag }}</title>
    <!-- Your custom meta tags go here -->
     <meta name="description" content="{!! $category->meta_description !!}">

 <meta name="keywords" content="{!! $category->meta_keyword !!}">
 <link rel="canonical" href="https://honeycombdeals.com/category/{{ Str::slug($category->title) }}">

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

    <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">






    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="impact-site-verification" value="de4ec733-7974-4b7d-a7aa-611819cb6e0f">
    <style>
           nav {
            background-color: rgb(93, 25, 130);
        }
        .card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-img-top {
    transition: transform 0.2s;
}

.card-img-top:hover {
    transform: scale(1.05);
}

    </style>

</head>
<body>

<x-navbar/>
<br>

<div class="container">
    <h1 class=" text-capitalize">{{  $category->title }}</h1>
    <p class="h5 m-0">Total stores: <span class="fw-bold">{{ $stores->count() }}</span></p>
</div>


<div class="container my-5">
    @if ($stores->isEmpty())
        <div class="alert alert-danger text-center" role="alert">
            No store found in this!
        </div>
    @else
        <div class="row">
            @foreach ($stores as $store)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @php

                        $storeurl = $store->slug
                        ? route('store_details', ['slug' => Str::slug($store->slug)])
                        : '#';
                        @endphp
                        <a href="{{$storeurl }}" class="text-decoration-none">
                            <img class="card-img-top" src="{{ $store->store_image ? asset('uploads/store/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}" alt="{{ $store->name }}" style="width:100%; height:200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">{{ $store->name ?: "Title not found" }}</h5>
                                @if (!$store->store_image)
                                    <p class="text-danger">Store image not found</p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>





     <x-alert/>



</body>
</html>
