<?php
header("X-Robots-Tag:index, follow");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title>{{$store->title?: 'No Title' }}</title>
    <link rel="canonical" href="https://honeycombdeals.com/store/{{ Str::slug($store->slug) }}">
        <meta name="description" content="{{ $store->meta_description ?: "No description" }}">
        <meta name="tag" content="{!! $store->meta_description !!}">


 <meta name="keywords" content="{{$store->meta_keyword  ?: "No keyword" }}">
   <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">


  <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">



    <!-- Bootstrap CSS v5.3.2 -->
       <link rel="stylesheet" href="{{ asset('front/assets/css/storedetail.css') }}">

<style>
    body{
        margin: 0;
        padding: 0;
    }
    .main-content{
        margin: 10px;
        padding: 10px;
    }
    .related-store{
        margin: 20px;
        padding: 20px;
    }
    .card-store{
        height:auto;
        border: 1px black solid;
    }
    .name {
    color: purple;
    background-size: cover;
    background-position: center;
    padding: 10px;
    margin-left: 2%;
    margin-right: 2%;
    background-image: url("{{ asset('images/back.jpg') }}");
}
.store-image{
margin-top:10px;
    width:270px;
    height: 200px;

}
.horizontal-scroll-container {
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 10px; /* Optional: Add space for scrollbar */
}

.horizontal-scroll-container .row {
    flex-wrap: nowrap; /* Prevent items from wrapping to the next line */
}

.horizontal-scroll-container .col-md-3,
.horizontal-scroll-container .col-sm-6 {
    flex: 0 0 auto; /* Ensure each card stays in the same row */
}
.content {
    margin: 0;
    padding: 10px;
    width: 100%;
    max-width: 100%;
    overflow-x: auto; /* Ensure horizontal scrolling for wide tables or images */
  }

.content img {
    max-width: 100%;
    height: auto; /* Make images responsive */
    display: block;
    margin: 0 auto; /* Optional: Center align images */
}



</style>
</head>
<body>
    <x-navbar/>

    <br>
    
<div class="main-content">
    <head aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                @if($store->category)
                    <a href="{{ route('related_category', ['title' => Str::slug($store->category)]) }}">
                        {{ $store->category }}
                    </a>
                @else
                    <span>No Category</span>
                @endif
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('stores') }}">Stores</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $store->slug }}
            </li>
        </ol>
    </head>
    
</div>
    @if ($store)
        <div class="container1 py-5 name">
            <div class="content-wrapper">
                <h1 class="text-center">{{ $store->name }}</h1>
            </div>
        </div>
        @endif
    
        @php
    $codeCount = 0;
    $dealCount = 0;
    foreach ($coupons as $coupon) {
        if ($coupon->code) {
            $codeCount++;
        } else {
            $dealCount++;
        }
    }
    $totalCount = $codeCount + $dealCount;
@endphp

<main class=" main-content">
    <div class="row">
        <!-- Store Description (Left Side) -->
        <div class="col-12 col-lg-3 mb-1 d-none d-md-block">
            <div class="card-store">
                <div class="card-body">
                    <!-- Store Image -->
                    <img src="{{ asset('uploads/store/' . $store->store_image) }}" alt="{{ $store->name }}" class="img-fluid img-thumbnail border-dark" >
                    <span class="store-name d-block font-weight-bold mt-2">{{ $store->slug }}</span>
                    
                    <!-- Store Rating -->
                    <div class="rating-stars text-warning mb-2">
                        <i class="fas fa-star" data-rating="1"></i>
                        <i class="fas fa-star" data-rating="2"></i>
                        <i class="fas fa-star" data-rating="3"></i>
                        <i class="fas fa-star" data-rating="4"></i>
                        <i class="fas fa-star text-dark" data-rating="5"></i>
                    </div>
                    
                    <!-- Created At -->
                    <span class="ending-date d-block text-muted">
                        Created At: {{ \Carbon\Carbon::parse($store->created_at)->setTimezone('Asia/Karachi')->format('d M Y, h:i A') }}
                    </span>
    
                    <!-- Store Description -->
                    @if ($store->description)
                        <p class="store_detail_description mt-2">
                            <span class="short-description">{!! \Illuminate\Support\Str::words(strip_tags($store->description), 20, '...') !!}</span>
                            <span class="full-description d-none">{!! $store->description !!}</span>
                            @if (strlen(strip_tags($store->description)) > 200)
                                <a href="#" class="text-danger toggle-description">Show More</a>
                            @endif
                        </p>
                    @endif
    
                    <!-- Store Summary -->
                    <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                        <strong class="mb-3" style="font-weight: bold;">Summary</strong>
                        <p style="font-size: 1.2em; margin: 0;">
                            <i class="fas fa-tag me-2"></i>Total Codes:
                            <span class="badge bg-primary">{{ $codeCount }}</span>
                        </p>
                        <p style="font-size: 1.2em; margin: 0;">
                            <i class="fas fa-shopping-cart me-2"></i>Total Deals:
                            <span class="badge bg-success">{{ $dealCount }}</span>
                        </p>
                        <p style="font-size: 1.2em; margin: 0;">
                            Total:
                            <span class="badge bg-info">{{ $totalCount }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Coupons Section (Right Side) -->
        <div class="col-12 col-lg-9">
            <div class="row mb-3">
                @foreach ($coupons as $coupon)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="card border-dark ">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-center align-items-center mb-3" style="height: 200px;">
                                @if ($store->store_image)
                                    <img src="{{ asset('uploads/store/' . $store->store_image) }}" alt="{{ $store->name }} Image" class="store-image" >
                                @else
                                    <span class="no-image-placeholder d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; background-color: #f0f0f0; color: #888; font-size: 14px;">No Image Available</span>
                                @endif
                            </div>
     
                            <div class="name-section mb-3">
                                <span class="text-left text-name">{{ $coupon->name }}</span>
                            </div>
     
                            <div class="description-section mb-3">
                                @if ($coupon->description)
                                    <p class="text-left text-description">{!! $coupon->description !!}</p>
                                @endif
                            </div>
     
                            <div class="ending-date-used-section ">
                                <span class="ending-date">Ending Date: {{ $coupon->ending_date }}</span>
                                <br>
                                <span class="used" id="output_{{ $coupon->id }}">Used By: {{ $coupon->clicks }}</span>
                            </div>
     
                            <div class="coupon-section ">
                                @if ($coupon->code)
                                    @php $codeCount++; @endphp
                                    <div class="d-grid gap-2 flex-grow-1 d-flex flex-column mt-3">
                                        <div class="coupon">
                                            <a href="{{ $coupon->destination_url }}" target="_blank" class="getcode" id="getCode{{ $coupon->id }}" onclick="countAndHandleClicks('{{ $coupon->id }}')">Activate Code</a>
     
                                            <div class="coupon-card d-flex flex-column flex-grow-3 mt-3">
                                                <span class="codeindex text-dark" style="display: none;" id="codeIndex{{ $coupon->id }}">{{ $coupon->code }}</span>
                                                <button class="btn btn-primary btn-sm copy-btn" style="display: none;" id="copyBtn{{ $coupon->id }}" onclick="copyToClipboard('{{ $coupon->id }}')">Copy Code</button>
                                                <p class="text-success copy-confirmation" style="display: none;" id="copyConfirmation{{ $coupon->id }}">Code copied!</p>
     
                                                <div class="mt-auto couponuse"></div>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('update.clicks') }}" id="clickForm">
                                            @csrf
                                            <input type="hidden" name="coupon_id" id="coupon_id">
                                        </form>
                                    </div>
                                @else
                                    @php $dealCount++; @endphp
                                    <div class="d-grid mt-3">
                                        <a href="{{ $coupon->destination_url }}" class="get" target="_blank" onclick="countAndHandleClicks('{{ $coupon->id }}')">Activate Deal</a>
                                    </div>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
</main>
    
    @if(empty($store->content))
        <div class="content bg-light">
            <p>No Content</p>
        </div>
    @else
        <div class="content">
            <p>{!! $store->content !!}</p>
        </div>
    @endif
    
    <!-- Related Stores -->
    <div class="container">
        <h2 class="text-center mb-4">Related Stores</h2>
    </div>
<section class="related-store">
        
    <div class="horizontal-scroll-container">
        <div class="row flex-nowrap">
            @foreach ($relatedStores as $relatedStore)
                @php
                    $storeurl = $relatedStore->slug
                        ? route('store_details', ['slug' => Str::slug($relatedStore->slug)])
                        : '#';
                @endphp
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a href="{{ $storeurl }}">
                            <img src="{{ asset('uploads/store/' . $relatedStore->store_image) }}" 
                                 alt="{{ $relatedStore->slug }}" 
                                 class="card-img-top img-fluid rounded-top" 
                                 style="height: 150px; object-fit: contain;">
                        </a>
                        <div class="card-body text-center">
                            <span class="card-title text-dark">{{ $relatedStore->slug ?: "Slug not found" }}</span>
                            <div class="d-grid gap-2">
                                <a href="{{ $storeurl }}" class="btn btn-dark btn-sm">View Store</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    

</div>
<br>
     <x-alert/>

     <script>
        // Handle clicks on coupon activation
        function countAndHandleClicks(couponId) {
            // Send AJAX request to update click count
            $.ajax({
                url: '{{ route('update.clicks') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon_id: couponId
                },
                success: function(response) {
                    // Handle response if needed
                    console.log('Click count updated successfully.');
                },
                error: function(xhr) {
                    console.error('Failed to update click count:', xhr.responseText);
                }
            });

            // Handle showing the coupon code
            var couponLink = $('#getCode' + couponId);
            var couponCode = $('#codeIndex' + couponId);
            var copyBtn = $('#copyBtn' + couponId);

            couponLink.hide();
            couponCode.show();
            copyBtn.show();

            // Store the clicked state in local storage
            localStorage.setItem('couponClicked_' + couponId, true);
        }

        // Function to copy coupon code to clipboard
        function copyToClipboard(couponId) {
            var couponCode = $('#codeIndex' + couponId).text().trim();
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(couponCode).select();
            document.execCommand('copy');
            tempInput.remove();

            // Show copy confirmation message
            var copyConfirmation = $('#copyConfirmation' + couponId);
            copyConfirmation.fadeIn().delay(1000).fadeOut();
        }

 

        // Toggle description visibility
        $(document).ready(function () {
            $('.toggle-description').on('click', function (e) {
                e.preventDefault();
                var shortDescription = $(this).siblings('.short-description');
                var fullDescription = $(this).siblings('.full-description');

                if (shortDescription.is(':visible')) {
                    shortDescription.hide();
                    fullDescription.show();
                    $(this).text('Show Less');
                } else {
                    shortDescription.show();
                    fullDescription.hide();
                    $(this).text('Show More');
                }
            });
        });
    </script>


</body>
</html>
