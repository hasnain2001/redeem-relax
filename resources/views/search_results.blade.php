<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
 <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
       <!-- Fonts -->
       <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('cssfile/styles.css')}}">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
     <style>
           .get,.navbar-custom .btn,.navbar-custom .nav-link,.navbar-custom .navbar-brand{color:#fff}.navbar-custom{background-color:#f00505}.navbar-custom .btn-outline-danger{border-color:#fff;color:#fff}.navbar-custom .btn-outline-danger:hover{background-color:#fff;color:#dc3545}.get{background:linear-gradient(to right,#ff416c,#ff4b2b);border:2px solid #fff;border-radius:25px;padding:10px 20px;font-size:16px;cursor:pointer;transition:.3s;box-shadow:0 4px 5px rgba(0,0,0,.1)}.card-body{flex:1 0 auto}.anchor-search{font-family:Arial;color:#000;text-decoration:none}.anchor-search:hover{color:#000;text-decoration-color:#dc3545}.card{display:flex;flex-direction:column}.card-img-top{object-fit:cover;height:200px}.pointer{pointer-events:none}@media (max-width:767px){.card-img-top{height:auto;width:100%}}
     </style>
</head>
<body class="body">
@include('components.navbar')

<div class="container">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">Home</a>
            </li>
<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">Search</li>
        </ol>
    </nav>
    <!-- Display Stores -->
    <h3 class="pointer">Search Results</h3>
    <div class="main_content">
        <div class="container">
            <div class="row mt-3">
                @if ($stores->isEmpty())
                    <div class="col-12">
                        <h1>No stores found.</h1>
                    </div>
                @else
                    @foreach ($stores as $store)
                        <div class="col-6 col-lg-3 mb-4 d-flex">
                            <div class="card shadow flex-fill">
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
                                <a href="{{$storeurl }}" class="anchor-search">
                                    <div class="card-body d-flex flex-column">
                                        @if ($store->store_image)
                                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="card-img-top" alt="">
                                        @else
                                            <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" class="card-img-top" alt="">
                                        @endif
                                        <h5 class="card-title mt-3 mx-2">{{ $store->name ?? 'Title not found' }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<br><br>
@include('components.footer')
<script>
        document.addEventListener('copy', function(e) {
    e.preventDefault();
    alert('Copying is disabled on this page.');
});

document.addEventListener('contextmenu', function(e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
        alert('Saving images is disabled on this website.');
    }
});


</script>
</body>
</html>
