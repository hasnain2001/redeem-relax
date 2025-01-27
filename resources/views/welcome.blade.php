<?php
header("X-Robots-Tag: index, follow");
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <!-- Meta and SEO tags -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="fo-verify" content="ceb298eb-128c-48ab-9e68-b45c90a37c2c" />
    <title>@yield('title')</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="John Doe">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">


   <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('cssfile/home.css') }}">
   
</head>

<body>
  

    <!-- Navbar -->
 <x-navbar/>

  

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
