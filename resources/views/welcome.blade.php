<?php
header("X-Robots-Tag: index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta and SEO tags -->
    <link rel="icon" href="{{ asset('front/assets/images/icons.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="fo-verify" content="ceb298eb-128c-48ab-9e68-b45c90a37c2c" />
    <title>Honeycomb Deals - Best Deals and Discounts | Honeycomb Deals</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Find the best deals, discounts, and coupons on Honeycomb Deals. Save money on your favorite products from top brands.">
    <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing">
    <meta name="author" content="John Doe">
    <meta name="robots" content="index, follow">

    <!-- Canonical and Sitemap -->
    <link rel="canonical" href="https://honeycombdeals.com">
    <link rel="sitemap" type="application/xml" href="sitemap.xml">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/home.css') }}">
 

    <!-- Verification Codes -->
    <meta name="partnerboostverifycode" content="32dc01246faccb7f5b3cad5016dd5033" />
    <meta name="impact-site-verification" value="de4ec733-7974-4b7d-a7aa-611819cb6e0f">
    <meta name="pct-site-verification" content="y03vub71r4uj611h31a1abl6ra1457w3qxrz6wzzvs3"/>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H7572N4HKL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-H7572N4HKL');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-NJNM88GL');</script>
<style>
.slider-image {
    height: 500px; /* Default height for large screens */
    width: 100%; /* Ensure the image takes full width of the container */
    border: 15px solid white;
    border-radius: 55px;
    box-shadow: 0px 4px 18px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    object-fit: cover; /* Ensures the image scales properly without distortion */
}

/* Media query for tablets and medium screens */
@media (max-width: 768px) {
    .slider-image {
        width: 300px%;
        height: 250px; /* Reduce height for tablets */
        border-radius: 45px;
        box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2); /* Slightly reduce shadow */
    }
}


/* For tablets and medium-sized devices (up to 768px) */
@media (max-width: 768px) {
    .slider-image {
        height: 300px; /* Slightly smaller height */
        border-radius: 40px; /* Less rounded corners */
        box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2); /* Reduced shadow */
    }
}

/* For smaller tablets and large mobile devices (up to 576px) */
@media (max-width: 576px) {
    .slider-image {
        height: 200px; /* Smaller height */
        border-radius: 35px; /* Slightly less rounded corners */
        box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.15); /* Less shadow */
    }
}

/* For extra small devices (mobile phones, up to 375px) */
@media (max-width: 375px) {
    .slider-image {
        height: 150px; /* Minimum height for smaller devices */
        border-radius: 25px; /* Subtle rounding */
        box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.1); /* Minimal shadow */
    }
}



</style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJNM88GL" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    <!-- Navbar -->
 <x-navbar/>

    <!-- Slider -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slider1.jpeg')}}" class="d-block w-100 slider-image "alt="..." loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/honeycombslider2.png') }}" class="d-block w-100 slider-image" alt="..." loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/wddddd (1).png') }}" class="d-block w-100 slider-image" alt="..." loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/tiSsDA (1).png') }}" class="d-block w-100 slider-image" alt="..." loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/sliderhoney (1).png') }}" class="d-block w-100 slider-image" alt="..." loading="lazy">
            </div>
        </div>
        <button class="slider-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="slider-prev-icon" aria-hidden="true"><i class="fa-solid fa-circle-left"></i></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="slider-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="slider-next-icon" aria-hidden="true"><i class="fa-solid fa-circle-right"></i></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

{{-- Main Content Here --}}
@yield('main-content')
{{-- Main Content Here --}}
<x-footer/>

<script >



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


</script>
   

 
</body>
</html>
