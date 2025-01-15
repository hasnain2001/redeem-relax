<?php
header("X-Robots-Tag:index, follow");
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('imprint.imprint') }} | CouponsArena | Latest Discount Codes of 2024</title>
    <meta http-equiv="refresh" content="70">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://couponsarena.com">
    <meta name="description" content="Explore exclusive discounts and offers on top brands. Save money on your online shopping with CouponsArena.">
    <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing, promo codes, cashback, online shopping, special offers, vouchers, best prices, holiday sales, seasonal discounts, gift cards, price comparison, money-saving tips">
    <meta name="author" content="Uzair">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb {
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a.active {
            color: #333;
            font-weight: bold;
        }

        .text-main {
            line-height: 1.6;
        }

        .page-heading {
            font-size: 2em;
            margin-bottom: 10px;
            color: #333;
        }

        .contact-info {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contact-info a {
            color: #007bff;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

   @include('components.navbar')
   <br><br>
    <div class="container">
        <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">{{ __('imprint.home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">{{ __('imprint.active') }}</li>
            </ol>
        </nav>

        <div class="text-main">
            <h1 class="page-heading">{{ __('imprint.imprint') }}</h1>
            <h2>{{ __('imprint.contact_information') }}</h2>
            <div class="contact-info">
                <p><strong>Redeem Relax Inc.</strong></p>
                <p><strong>Address: 473 Mundet Place, New Jersey, US</strong></p>
                <p><strong>Zip Code: 07205</strong></p>         
                <p><strong>{{ __('imprint.email_us') }}</strong> +1 973 253 3800 </p>
                <p><strong>Email:<a href="mailto:contact@redeemrelax.com " class=" text-decoration-none"> contact@redeemrelax.com </a></strong> </p>
           
            </div>
        </div>
    </div>
   @include('components.footer')
</body>
</html>
