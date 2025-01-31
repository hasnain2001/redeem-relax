<?php
header("X-Robots-Tag:index, follow");
?><!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Contact - Best Deals and Discounts |CouponsArena</title>
     <meta name="description" content="Find the best deals, discounts, and coupons on CouponsArena. Save money on your favorite products from top brands.">

 <meta name="keywords" content="deals, discounts, coupons, savings, affiliate marketing">

  <meta name="author" content="John Doe">
 <meta name="robots" content="index, follow">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
<link rel="canonical" href="https://CouponsArena.com/about">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

<style>
  body {
        font-family: 'figtree', sans-serif;
        background-color: #f8f9fa;
    }

    .contact-us h1 {
        font-size: 2.5rem;
        font-weight: 600;
    }
    .contact-us form {
        background-color: #fff;
        padding: 20px;
        border-radius: 0.25rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .contact-us form .form-group {
        margin-bottom: 1rem;
    }
    .contact-us form .form-group label {
        font-weight: 500;
    }
    .contact-us form .form-control {
        border-radius: 0.25rem;
    }
    .contact-us form .form-control:focus {
        box-shadow: none;
    }
    .contact-us form .form-control::placeholder {
        font-weight: 500;
    }
    .contact-us form .form-control:focus::placeholder {
        font-weight: 500;
    }
    .contact-us form .form-control:focus {
        border-color: #8a2be2;
    }
    .contact-us form .form-control:focus::placeholder {
        color: #8a2be2;
    }
    .contact-us form .btn-purple {
        background-color: #701e7d;
        color: #fff;
        font-weight: 500;
        border-radius: 0.25rem;
    }
    .contact-us form .btn-purple:hover {
        background-color: #53085f;
    }
    .contact-us form .btn-purple:focus {
        box-shadow: none;
    }
    .contact-us form .btn-purple:active {
        background-color: #6a1e9b;
    }
    .contact-us form .btn-purple:active:focus {
        box-shadow: none;
    }
    .contact-us form .btn-purple:active:focus::placeholder {
        color: #fff;
    }
    .contact-us form .btn-purple:active:focus {
        border-color: #fff;
    }
    .contact-us form .btn-purple:active:focus {
        color: #fff;
    }
    .contact-us form .btn-purple:active:focus {
        background-color: #6a1e9b;
    }
    .contact-us form .btn-purple:active:focus
    .contact-us form .btn-purple:active:focus {
        box-shadow: none;
    }
</style>


</head>
<body >
@include('components.navbar')
<section class="contact-us py-5  text-capitalize ">
  <div class="container">
    <nav aria-label="breadcrumb" style=" border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-primary" style="font-weight: 500;">Home</a>
            </li>
<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">Contact</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{asset('images/contact.png')}}" alt="Company Image" class="img-fluid rounded shadow-sm" style="height:400px; width:100%;">
      </div>
      <div class="col-md-6">
        <h1 class="display-6 text-dark text-center mb-4">@lang('message.contact')</h1>
        <form action="#" method="POST" class="row justify-content-center">
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="firstName" class="form-label">@lang('message.First Name')</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="lastName" class="form-label">@lang('message.Last Name')</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="email" class="form-label">@lang('message.Email Address')</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="website" class="form-label">@lang('message.Website Name')</label>
              <input type="text" class="form-control" id="website" name="website" required>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="form-group">
              <label for="message" class="form-label">@lang('message.Write your message')</label>
              <textarea class="form-control" id="message" name="message" rows="8" required></textarea>
            </div>
          </div>
          <div class="col-12 mb-3">
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-purple btn-lg">@lang('message.Submit')</button>
          </div>
        </div>
      
        </form>
      </div>
      <div class="col-5 mt-4">

        <div class="embed-responsive embed-responsive-16by9">
<!-- for map div---->
        </div>
      </div>
    </div>
  </div>
</section>


<br>
   <br>

   @include('components.footer')

</body>
</html>
