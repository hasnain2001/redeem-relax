<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Mega Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('cssfile/navbar.css') }}">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="logo">
            <a href="/">  <img src="{{ asset('images/logo.png') }}" alt="Logo" loading="lazy"></a>
        </div>
      
        <ul class="nav-list" id="nav-list">
            <div class="logo-mb d-block d-sm-none">
                <a href="/">  <img src="{{ asset('images/logo.png') }}" alt="Logo" loading="lazy"></a>
            </div>
            <li><a href="{{ url(app()->getLocale() . '/') }}">@lang('message.home')</a></li>
            <li><a href="{{ url(app()->getLocale() . '/stores') }}">Stores</a></li>
            <li class="mega-dropdown d-none d-sm-block">
                <a href="#" class=" dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">@lang('message.category')</a>
                <div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4">
                                <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}">{{ $category->title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </li>
      
            <li class="d-block d-sm-none">
                <a href="#" id="categories-button">
                    @lang('message.category') <i class="fas fa-chevron-down"></i>
                </a>
           
            </li>
                   <!-- Modal for Mobile Categories -->
                   <div id="categories-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-modal">&times;</span>
                        <h3>Categories</h3>
                        <div class="categories-list">
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-12">
                                        <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}">{{ $category->title }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            
      
         <li class="d-block d-sm-none">
            <a href="#" id="region-button">
                {{ strtoupper(app()->getLocale()) }}  <i class="fas fa-chevron-down"></i>
            </a>
        </li>
        
        <!-- Modal for Mobile Region -->
        <div id="region-modal" class="modal">
            <div class="modal-content">
                <span class="close-region-modal">&times;</span>
                <h3>{{ strtoupper(app()->getLocale()) }} </h3>
                <div class="categories-list">
                    <div class="row">
                        @foreach ($langs as $lang)
                            <div class="col-12">
                                <a href="{{ url('/' . $lang->code) }}">   {{ strtoupper($lang->code) }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
          
            
            
<li><a href="{{ url(app()->getLocale() . '/contact') }}">@lang('message.contact')</a></li>
            <li><a href="{{ url(app()->getLocale() . '/blog') }}">@lang('message.news')</a></li>
     
            

    <div class="search-container">
        <form id="searchForm" action="{{ route('search') }}" method="GET" class="d-flex" role="search">
            <input type="search" name="query" id="searchInput" placeholder="@lang('message.search')">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

 <li class="nav-item dropdown list-unstyled  d-none d-sm-block">
    <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ strtoupper(app()->getLocale()) }} 
    </a>
    <ul class="dropdown-menu text-center shadow" aria-labelledby="navbarDropdown" style="min-width: auto;">
        @foreach ($langs as $lang)
            <li class="">
                <a href="{{ url('/' . $lang->code) }}" class="dropdown-item text-dark">
                    {{ strtoupper($lang->code) }}
                </a>
            </li>
        @endforeach
    </ul>
</li>


        </ul>
   
        <div class="menu-toggle" id="mobile-menu">&#9776;</div>
    </nav>


<script src="{{ asset('js/navbar.js') }}"></script>
    

</body>
</html>
