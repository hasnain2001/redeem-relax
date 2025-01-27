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
  <link rel="canonical" href="https://redeemrelax.com/">
  @endif


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('cssfile/storedetail.css')}}">
<style>
    .social-container .btn {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease-in-out, background-color 0.3s ease;
}

.social-container .btn:hover {
    transform: scale(1.1);
    opacity: 0.9;
}

.social-container .btn i {
    font-size: 16px;
}


</style>
</head>
<body>

<x-navbar></x-navbar>


<br>


@if(session('success'))
<div class="alert alert-light alert-dismissable">
    <b>{{ session('success') }}</b>
</div>
@endif

<!-- Store Information and Coupons Section -->
<div class="container-fluid">
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

    <div class="container-fluid">

        <div class="row">
            <!-- Store Information Card -->
            <div class="col-12 card shadow-sm p-4 mb-4">
                <div class="row">
         
                <div class="col-12 col-md-3 text-left">
             
                    @if ($store->store_image)
                        <img src="{{ asset('uploads/stores/' . $store->store_image) }}" 
                             class=" img-fluid img-thumbnail mb-3" 
                             alt="{{ $store->name }}">
                    @endif
           
                </div>
        
                    <div class="col-12 col-md-9">
                        <section class="store">
                        <div class="card-body store">
                            <h3 class="store-name">{{ $store->name }}</h3>
                            <p class=" store-description">{!! $store->description !!}</p>
                <span> Since At :  {{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Coupons Section -->
            <div class="col-12 col-md-8">
                <div class="row">
                    @foreach ($coupons as $coupon)
                        <div class="col-12 mb-4">
                            <div class="coupon-card card p-3 rounded shadow-sm">
                                <div class="card-body d-flex flex-column flex-md-row align-items-start">
                                    <!-- Coupon Image -->
                                    <div class="mb-4 mb-md-0 me-md-4">
                                        @if ($store->store_image)
                                            <img class="stores-img shadow img-fluid" 
                                                 src="{{ asset('uploads/stores/' . $store->store_image) }}" 
                                                 alt="Card Image">
                                        @endif
                                    </div>
    
                                    <!-- Coupon Information -->
                                    <div class="flex-grow-1 mb-3 mb-md-0">
                                        
                                        <strong class=" coupon-name mb-2">{{ $coupon->name }}</strong>
                                        <p class="coupon-description">{{ $coupon->description }}</p>
                                        <span class="ending-date" style="color: {{ strtotime($coupon->ending_date) < strtotime(now()) ? '#951d1d' : '#909090' }};">
                                            Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                                        </span>
                                    </div>
    
                                    <!-- Coupon Code or Get Deal Button -->
                                    <div class="mb-2 d-flex flex-column align-items-center">
                                        @if ($coupon->code)
<a href="{{ $coupon->destination_url }}" target="blank" class="getcode" id="getCode{{ $coupon->id }}" onclick="toggleCouponCode('{{ $coupon->id }}')">Reveal Code</a>
<div class="coupon-card d-flex flex-column">
<span class="codeindex text-dark scratch" style="display: none;" id="codeIndex{{ $coupon->id }}">{{ $coupon->code }}</span>
<button class="btn btn-info text-white btn-sm copy-btn btn-hover d-none mt-2" id="copyBtn{{ $coupon->id }}" onclick="copyCouponCode('{{ $coupon->id }}')">Copy Code</button>
<p class="text-success copy-confirmation d-none mt-3" id="copyConfirmation{{ $coupon->id }}">Code copied!</p>
</div>
                                        @else
                                            <a href="{{ $coupon->destination_url }}" 
                                               onclick="updateClickCount('{{ $coupon->id }}')" 
                                               class="get  " 
                                               target="_blank">Get Deal</a>
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
            <div class="col-12 col-md-4">
                <hr>
                <div class="store-info-card card shadow-sm p-3 mb-5 bg-white rounded">
                    <h4 class="text-center mb-4">Filter By Voucher Codes</h4>
                    <div class="d-flex flex-column btn-sort">
                        <a href="{{ url()->current() }}" class="  mb-2">All</a>
                        <a href="{{ url()->current() }}?sort=codes" class="  mb-2">Codes</a>
                        <a href="{{ url()->current() }}?sort=deals" class=" mb-2">Online Sales</a>
                    </div>
                </div>

<!-- Social Share Section -->
<div class="social-container widget-col-item mt-4">
    <p class="widget-title text-center">Share To Your Friends</p>
    <div class="social-box1 footer-social">
        <ul class="list-inline row justify-content-center gap-3 gap-md-4">
            <!-- Facebook Share -->
            <li class="list-inline-item col-auto">
                <a class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                   href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   aria-label="Share on Facebook" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="top" 
                   title="Share on Facebook">
                   <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <!-- Twitter Share -->
            <li class="list-inline-item col-auto">
                <a class="btn btn-info btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                   href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Check out amazing deals from {{ $store->name }}!" 
                   target="_blank" 
                   aria-label="Share on Twitter" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="top" 
                   title="Share on Twitter">
                   <i class="fab fa-twitter"></i>
                </a>
            </li>
        
                <!-- Email Share -->
            <li class="list-inline-item col-auto">
                <a class="btn btn-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                   href="mailto:?subject=Check out amazing deals from {{ $store->name }}!&body=Check out these deals: {{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   aria-label="Share via Email" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="top" 
                   title="Share via Email">
                   <i class="fas fa-envelope"></i>
                </a>
            </li>
                <!-- Custom Share Button -->
                <li class="list-inline-item col-auto dropdown">
                    <button class="btn btn-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                            id="customShareDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false" 
                            aria-label="Custom Share" 
                            title="Choose where to share">
                        <i class="fas fa-share-alt"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="customShareDropdown">
                        <!-- Reddit -->
                        <li>
                            <a class="dropdown-item" href="https://www.reddit.com/submit?url={{ urlencode(url()->current()) }}&title=Check out amazing deals from {{ $store->name }}!" target="_blank">
                                <i class="fab fa-reddit text-danger me-2"></i>Share on Reddit
                            </a>
                        </li>
                        <!-- Tumblr -->
                        <li>
                            <a class="dropdown-item" href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ urlencode(url()->current()) }}&title=Check out amazing deals!" target="_blank">
                                <i class="fab fa-tumblr text-primary me-2"></i>Share on Tumblr
                            </a>
                        </li>
                        <!-- Telegram -->
                        <li>
                            <a class="dropdown-item" href="https://telegram.me/share/url?url={{ urlencode(url()->current()) }}&text=Check out amazing deals from {{ $store->name }}!" target="_blank">
                                <i class="fab fa-telegram text-info me-2"></i>Share on Telegram
                            </a>
                        </li>
                        <!-- Messenger -->
                        <li>
                            <a class="dropdown-item" href="https://www.facebook.com/dialog/send?app_id=YOUR_APP_ID&link={{ urlencode(url()->current()) }}&redirect_uri={{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fab fa-facebook-messenger text-primary me-2"></i>Share on Messenger
                            </a>
                        </li>
                        <!-- LinkedIn -->
                        <li>
                            <a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title=Check out amazing deals from {{ $store->name }}!" target="_blank">
                                <i class="fab fa-linkedin text-primary me-2"></i>Share on LinkedIn
                            </a>
                        </li>
                        <!-- Email -->
                        <li>
                            <a class="dropdown-item" href="mailto:?subject=Check out amazing deals from {{ $store->name }}!&body=Check out these deals: {{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fas fa-envelope text-secondary me-2"></i>Share via Email
                            </a>
                        </li>
                        <!-- WhatsApp -->
                        <li>
                            <a class="dropdown-item" href="https://api.whatsapp.com/send?text=Check out amazing deals from {{ $store->name }}! {{ urlencode(url()->current()) }}" target="_blank">
                                <i class="fab fa-whatsapp text-success me-2"></i>Share on WhatsApp
                            </a>
                        </li>
                    </ul>
                </li>
                
        </ul>
    </div>
</div>




                <div class="store-info-card card shadow-sm p-3 mb-5 bg-white rounded">
                    <h4 class="text-center mb-4">Related Stores</h4>
                    <div class="row row-cols-2 gy-3">
                        @foreach ($relatedStores as $store)
                        @php
                        $language = $store->language->code;
                        $storeSlug = Str::slug($store->slug);
                      
                        // Conditionally generate the URL based on the language
                        $storeurl = $store->slug
                            ? ($language === 'en'
                                ? route('store_details', ['slug' => $storeSlug])  // English route without 'lang'
                                : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))  // Other languages
                            : '#';
                      @endphp
                            <div class="col text-center">
                                <a href="{{ $storeurl }}" class="text-decoration-none">
                                    <div class="related-store-box">
                                        <span class="store-link">{{ $store->name }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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

document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

</script>
</body>
</html>
