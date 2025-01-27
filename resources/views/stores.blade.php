<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores - Best Deals and Discounts |CouponsArena</title>
     <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing">

       <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">

    <!-- Styles -->
     <meta name="description" content="Find the best deals, discounts, and coupons on CouponsArena. Save money on your favorite products from top brands.">
<link rel="canonical" href="{{ url()->current() }}">

<link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">

           <style>
.my-pagination{flex-wrap:wrap}.my-pagination .page-item{margin:5px}.my-pagination .page-link{border:1px solid #ddd;border-radius:50%;padding:10px 15px;color:#007bff;transition:background-color .3s,color .3s}.my-pagination .page-link:hover{background-color:red;color:#fff;text-decoration:none}.my-pagination .page-item.active .page-link{background-color:#007bff;border-color:#007bff;color:#fff}@media (max-width:768px){.my-pagination .page-link{padding:8px 12px;font-size:14px}}@media (max-width:576px){.my-pagination .page-link{padding:6px 10px;font-size:12px}}.card-list{display:flex;flex-wrap:wrap;justify-content:center}.card-link{display:block;color:inherit;text-decoration:none}.card{transition:transform .2s}.card:hover{transform:translateY(-5px)}.stores-img{width:100px;height:100px;object-fit:cover;border-radius:50%}.card-title{font-size:18px;color:#333;margin-top:15px;text-align:center}@media (max-width:768px){.card-list .col-sm-12{margin-bottom:20px}.card-title{font-size:16px}}
</style>
</head>
<body class="body">
    <!--navbar -->
@include('components.navbar')
    <!--navbar -->

    {{-- <ul class="pagination justify-content-center my-pagination">
        @foreach(range('A', 'Z') as $letter)
            <li class="page-item">
                <a class="page-link" href="{{ route('stores', ['letter' => $letter]) }}">{{ $letter }}</a>
            </li>
        @endforeach
    </ul> --}}



<div class="container">

    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('message.home')</a>
                    </li>
                

<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">Stores</li>
        </ol>
    </nav>
    <p class="h5 m-0">Total stores: <span class="fw-bold">{{ $stores->total() }}</span></p>

    <div class="row card-list g-4">
        @forelse ($stores as $store)
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
              @php

              $storeurl = $store->slug
              ? route('store_details', ['slug' => Str::slug($store->slug)])
              : '#';
              @endphp


<a href="{{ $storeurl }}" class="card-link text-decoration-none">


                <div class="shadow-bg h-100">
                    <div class="card-body text-center">
                        <img class="shadow  card-img img-thumbnail" src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}" loading="lazy" alt="Card Image">
                        <h5 class="card-title mt-3">{{ $store->name ?: "Title not found" }}</h5>
                    </div>
                </div>


                    </a>

            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    No Stores Found!!!
                </div>
            </div>
        @endforelse
    </div>

    {{$stores->links('vendor.pagination.custom')  }}
</div>


<br>
@include('components.footer')

</body>
</html>
