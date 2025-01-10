@extends('welcome')
@section('title')

@endsection
@section('main-content')
<!-- Custom CSS for Styling -->
 <style>
.conatain{padding:5%}.coupon-card{transition:transform .5s ease-in-out,box-shadow .5s ease-in-out,border .5s ease-in-out}.coupon-card:hover{transform:scale(1.05);box-shadow:0 10px 30px rgba(0,0,0,.2);border:2px solid #151618}.coupon-image{width:100%;height:150px;object-fit:contain;padding:10px;background-color:#f9f9f9;border-bottom:1px solid #ddd}.no-image-placeholder{height:150px;display:flex;justify-content:center;align-items:center;background-color:#f8f9fa}.coupon-body{text-align:left;padding-left:12px;padding-right:12px}.btn{background-color:#060607;color:#fff}.btn:hover{background-color:#252f38;color:#fff}.modal-content{background:#f7f7f7}.title{color:#050607}.top-store-name{color:#1e1e1f;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;font-size:14px;padding:5px 5px 5px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%}.card-body-store{color:#1e1e1f;background-color:#dbdbdb;border-radius:5%;height:100%;padding:15px}@media (max-width:768px){.top-store-name{white-space:normal}}
 </style>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators custom-carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/banner1.png') }}" class="d-block w-100 slider-image" alt="Slide 1" loading="lazy">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/couponsarenaslider.png') }}" class="d-block w-100 slider-image" alt="Slide 2" loading="lazy">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/Untitled-2 (1).png') }}" class="d-block w-100 slider-image" alt="Slide 3" loading="lazy">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/black friday sale.png') }}" class="d-block w-100 slider-image" alt="Slide 4"  loading="lazy">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" loading="lazy">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="conatain">
<div class="row mb-4">
<div class="col-12">
<h2 class="title text-center">@lang('message.Trending Promo Codes To Save Everyday')</h2>
</div>
</div>
<div class="row coupon-grid g-4">
@foreach ($topcouponcode as $coupon)
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="coupon-card h-100 card rounded ">
@php
// Retrieve associated store and handle unavailable images
$store = App\Models\Stores::where('slug', $coupon->store)->first();
@endphp

<div class="coupon-header text-center">
@if ($store && $store->store_image)
<img src="{{ asset('uploads/stores/' . $store->store_image) }}"
  alt="{{ $store->name }} Image" class="coupon-image img-fluid"
  loading="lazy">
@else
<div class="no-image-placeholder bg-light text-center py-4">
<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
<path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>
<span>{{ $coupon->store }}</span>


</div>

      @endif
</div>

<div class="mb-4 coupon-body py-3 ">

<h6 class="text-left">{{ $coupon->name }}</h6>
<span class="d-block mb-2 {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-muted' }}">
Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M, Y') }}
</span>

<div class="d-grid gap-2">

<a href="{{ $coupon->destination_url }}" target="_blank" class=" btn  btn-sm btn-dark btn-hover" id="getCode{{ $coupon->id }}" onclick="toggleCouponCode('{{ $coupon->id }}')">@lang('message.Get Code')</a>
<div class="coupon-card d-flex flex-column">
    <span class="codeindex text-dark scratch" style="display: none;" id="codeIndex{{ $coupon->id }}">{{ $coupon->code }}</span>
    <button class="btn btn-info text-white btn-sm copy-btn btn-hover d-none mt-2" id="copyBtn{{ $coupon->id }}" onclick="copyCouponCode('{{ $coupon->id }}')">Copy Code</button>
    <p class="text-success copy-confirmation d-none mt-3" id="copyConfirmation{{ $coupon->id }}">Code copied!</p>

    <form method="post" action="{{ route('update.clicks') }}" id="clickForm">
        @csrf
        <input type="hidden" name="coupon_id" id="coupon_id">
    </form>
</div>
<p class="used font-weight-bold mt-2" id="output_{{ $coupon->id }}">@lang('message.Used By'): {{ $coupon->clicks }}</p>
</div>


</div>



</div>
</div>


@endforeach
</div>
</div>

<div class="conatain">
<div class="row mb-4">
<div class="col-12">
<h2 class="title text-center">@lang('message.Top Deals Today')</h2>
</div>
</div>
<div class="row coupon-grid g-4">
@foreach ($Couponsdeals as $coupon)
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="coupon-card h-100 card rounded ">
@php
// Retrieve associated store and handle unavailable images
$store = App\Models\Stores::where('slug', $coupon->store)->first();
@endphp

<div class="coupon-header text-center">
@if ($store && $store->store_image)
<img src="{{ asset('uploads/stores/' . $store->store_image) }}"
  alt="{{ $store->name }} Image" class="coupon-image img-fluid"
  loading="lazy">
@else
<div class="no-image-placeholder bg-light text-center py-4">
<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
<path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>
<span>{{ $coupon->store }}</span>

</div>

@endif

</div>

<div class="mb-4 coupon-body py-3 ">

<h6 class="text-left">{{ $coupon->name }}</h6>

<span class="d-block mb-2 {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-muted' }}">
Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M, Y') }}
</span>

<div class="d-grid gap-2">
<a href="{{ $coupon->destination_url }}" class="btn btn-dark" onclick="updateClickCount('{{ $coupon->id }}')" target="_blank">@lang('message.Get Deal')</a>
<form method="post" action="{{ route('update.clicks') }}" id="clickForm">
    @csrf
    <input type="hidden" name="coupon_id" id="coupon_id">
</form>
</div>
<p class="used font-weight-bold mt-2" id="output_{{ $coupon->id }}">@lang('message.Used By') {{ $coupon->clicks }}</p>
{{-- <span>top: {{ $coupon->top_coupons ?? 0 }}</span> --}}


</div>



</div>
</div>


@endforeach
</div>
</div>
<div class="container mt-5">
<h3 class="mb-4 title text-center">@lang('message.Popular Stores Today')</h3>
<div class="row justify-content-center">
<div class="col-md-12 card">
<div class="row row-cols-2 row-cols-md-6 g-3"> <!-- Using row-cols-2 to adjust columns for smaller screens -->
@foreach ($stores as $store)
<div class="col mb-4">
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



<a href="{{ $storeurl }}" class="card-link text-decoration-none">
        <div class="card-body card-body-store d-flex justify-content-center align-items-center">
            <span class="top-store-name text-center text-truncate">{{ $store->name }}</span> <!-- Added text-truncate for long names -->
        </div>
    </a>
</div>
{{-- <a href="{{ route('stores', ['lang' => $store->language->code, 'id' => $store->id]) }}">
  {{ $store->name }}
</a> --}}
@endforeach


</div>
</div>
</div>
</div>





<script src="{{ asset('front/assets/js/java.js') }}"></script>
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
@endsection
