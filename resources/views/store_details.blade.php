<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @if(isset($store) && is_object($store))
  <title>{!! $store->title !!}</title>
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{!! $store->meta_description !!}">
  <meta name="keywords" content="{!! $store->meta_keyword !!}">
  <meta name="author" content="Najeeb">
  <meta name="robots" content="index, follow">
  @else
  <link rel="canonical" href="https://vouchmenot.com/stores">
  @endif
  <!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $store->name }}" />
<meta property="og:description" content="Check out amazing deals from {{ $store->description }}!" />
<meta property="og:image" content="{{ asset('uploads/stores/' . $store->store_image) }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $store->name }}">
<meta name="twitter:description" content="Check out amazing deals from {{ $store->description }}!">
<meta name="twitter:image" content="{{ asset('images/store-logos/' . $store->logo) }}">
<meta name="twitter:url" content="{{ url()->current() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('cssfile/storedetail.css')}}">
</head>
<body>
<nav>
    @include('components.navbar')
</nav>

<br>


@if(session('success'))
<div class="alert alert-light alert-dismissable">
    <b>{{ session('success') }}</b>
</div>
@endif

<!-- Store Information and Coupons Section -->
<div class="container">
    <!-- Breadcrumb Navigation -->
    <div class="main-content">
        <head aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{{ url(app()->getLocale() . '/') }}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    @if($store->category)
                        <a class=" text-decoration-none" href="{{ route('related_category', ['slug' => Str::slug($store->category)]) }}">
                            {{ $store->category }}
                        </a>
                    @else
                        <span>No Category</span>
                    @endif
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/stores') }}" class="text-dark text-decoration-none">Stores</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $store->slug }}
                </li>
            </ol>
        </head>
        
    </div>
    <hr>

    <div class="row">
        <!-- Store Information Card -->
        <div class="col-12 card shadow-sm p-4 mb-4">
            <div class="row">
                <div class="col-md-1 text-left">
                    @if ($store->store_image)
                        <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="stores-img img-fluid img-thumbnail mb-3" alt="{{ $store->name }}">
                    @endif
                </div>
                <div class="col-md-11">
                    <div class="card-body">
                        <h3 class="card-title">{{ $store->name }}</h3>
                        <p class="card-text">{!! $store->description !!}</p>
                    </div>
                </div>
            </div>
        </div>

<!-- Coupons Section -->
<div class="col-md-8">
    <div class="row">
        @foreach ($coupons as $coupon)
            <div class="col-12 mb-4">
                <div class="coupon-card card p-3 rounded shadow-sm">
                    <div class="card-body d-flex flex-column flex-md-row align-items-start">
                        <!-- Coupon Image -->
                        <div class="mb-4 mb-md-0 me-md-4">
                            @if ($store->store_image)
                                <img class="stores-img shadow" src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="Card Image">
                            @endif
                        </div>

                        <!-- Coupon Information -->
                        <div class="flex-grow-1 mb-3 mb-md-0">
                            <h5 class="mb-2">{{ $coupon->name }}</h5>
                            <p style="width: 400px;">{{ $coupon->description }}</p>
                            <span class="date" style="color: {{ strtotime($coupon->ending_date) < strtotime(now()) ? '#951d1d' : '#909090' }};">
                                Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                            </span>
                        </div>

                        <!-- Coupon Code or Get Deal Button -->
                        <div class="mb-2 d-flex flex-column align-items-md-center">
                            @if ($coupon->code)
                                <a href="{{ $coupon->destination_url }}" target="blank" class="getcode" id="getCode{{ $coupon->id }}" onclick="toggleCouponCode('{{ $coupon->id }}')">Reveal Code</a>
                                <div class="coupon-card d-flex flex-column">
                                    <span class="codeindex text-dark scratch" style="display: none;" id="codeIndex{{ $coupon->id }}">{{ $coupon->code }}</span>
                                    <button class="btn btn-info text-white btn-sm copy-btn btn-hover d-none mt-2" id="copyBtn{{ $coupon->id }}" onclick="copyCouponCode('{{ $coupon->id }}')">Copy Code</button>
                                    <p class="text-success copy-confirmation d-none mt-3" id="copyConfirmation{{ $coupon->id }}">Code copied!</p>
                                </div>
                            @else
                                <a href="{{ $coupon->destination_url }}" onclick="updateClickCount('{{ $coupon->id }}')" class="get" target="_blank">Get Deal</a>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-2">
                        <span class="used">Used By: {{ $coupon->clicks }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

        <!-- Sidebar with Store Information -->
        <div class="col-md-4">
            <hr>
            <!-- Filter Section -->
            <div class="store-info-card card shadow-sm p-3 mb-5 bg-white rounded" style="max-width: 300px;">
                <h4 class="text-center mb-4">Filter By Voucher Codes</h4>
                <div class="d-flex flex-column">
                    <div class="btn-group " role="group">
                        <div class="btn-sort">   <a href="{{ url()->current() }}" class="mb-2">All</a>
                            <a href="{{ url()->current() }}?sort=codes" class=" mb-2">Codes</a>
                            <a href="{{ url()->current() }}?sort=deals" class=" mb-2">Online Sales</a></div>
                     
                    </div>
                </div>
            </div>

           <!-- Social Share Section -->
<div class="social-container widget-col-item">
    <p class="widget-title">Share</p>
    <div class="social-box1 footer-social">
        <ul class="list-inline d-flex justify-content-center">
            <!-- Facebook Share -->
            <li class="list-inline-item">
                <a class="btn btn-primary btn-sm rounded-circle" 
                   href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank">
                   <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <!-- Twitter Share -->
            <li class="list-inline-item">
                <a class="btn btn-info btn-sm rounded-circle" 
                   href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Check out amazing deals from {{ $store->name }}!" 
                   target="_blank">
                   <i class="fab fa-twitter"></i>
                </a>
            </li>
            <!-- Pinterest Share -->
            <li class="list-inline-item">
                <a class="btn btn-danger btn-sm rounded-circle" 
                   href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ asset('images/store-logos/' . $store->logo) }}&description=Check out amazing deals from {{ $store->name }}!" 
                   target="_blank">
                   <i class="fab fa-pinterest"></i>
                </a>
            </li>
            <!-- WhatsApp Share -->
            <li class="list-inline-item">
                <a class="btn btn-success btn-sm rounded-circle" 
                   href="https://api.whatsapp.com/send?text=Check out amazing deals from {{ $store->name }}! {{ urlencode(url()->current()) }}" 
                   target="_blank">
                   <i class="fab fa-whatsapp"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

            <!-- Related Stores Section -->
            <div class="store-info-card card shadow-sm p-3 mb-5 bg-white rounded">
                <h4 class="text-center mb-4">Related Stores</h4>
                <div class="row row-cols-2 row-cols-md-2 gy-3">
                    @foreach ($relatedStores as $store)
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
                    <div class="col">
                        <a href="{{ $storeurl }}" class="card-link text-decoration-none">
                            <div class="related-store-box text-center">
                                <span class="store-link">{{ $store->name }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
    <br><br>
</div>


<footer>
    @include('components.footer')
</footer>

<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
// Function to toggle coupon code visibility and copy button
function toggleCouponCode(couponId) {
    // Set the coupon ID in localStorage to remember the state
    localStorage.setItem('copiedCouponId', couponId);

    const codeElement = document.getElementById(`codeIndex${couponId}`);
    const copyButton = document.getElementById(`copyBtn${couponId}`);

    if (codeElement.style.display === 'none') {
        codeElement.style.display = 'inline';
        copyButton.classList.remove('d-none');
    } else {
        codeElement.style.display = 'none';
        copyButton.classList.add('d-none');
    }

    // Update the click count via AJAX
    updateClickCount(couponId);
}

// Check localStorage on page load to restore the state
document.addEventListener('DOMContentLoaded', function() {
    const copiedCouponId = localStorage.getItem('copiedCouponId');
    if (copiedCouponId) {
        const codeElement = document.getElementById(`codeIndex${copiedCouponId}`);
        const copyButton = document.getElementById(`copyBtn${copiedCouponId}`);

        codeElement.style.display = 'inline';
        copyButton.classList.remove('d-none');
    }
});

// Clear localStorage on refresh
window.addEventListener('beforeunload', function () {
    localStorage.removeItem('copiedCouponId');
});

// Function to copy coupon code to clipboard
function copyCouponCode(couponId) {
    const codeElement = document.getElementById(`codeIndex${couponId}`);
    const code = codeElement.innerText.trim();

    navigator.clipboard.writeText(code)
        .then(() => {
            // Show success message
            const copyMessage = document.getElementById(`copyConfirmation${couponId}`);
            copyMessage.classList.remove('d-none');
            setTimeout(() => {
                copyMessage.classList.add('d-none');
            }, 1500);
        })
        .catch(err => {
            console.error('Failed to copy: ', err);
        });
}

// Function to update click count via AJAX
function updateClickCount(couponId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("update.clicks") }}', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Click count updated successfully.');
        }
    };

    xhr.send('coupon_id=' + couponId);
}

// Function to count clicks (fallback if not using AJAX)
function countClicks(couponId) {
    document.getElementById('coupon_id').value = couponId;
    document.getElementById('clickForm').submit();
}

</script>
</body>
</html>
