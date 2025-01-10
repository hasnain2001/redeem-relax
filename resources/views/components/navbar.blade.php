<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="{{asset('cssfile/navbar.css')}}">
  
</head>
<body>

    <header class="header-container sticky-top">
        <!-- Logo section -->
        <div class="logo-container d-sm-block d-none">
            <a class="navbar-brand" href="{{ url(app()->getLocale() . '/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" loading="lazy">
            </a>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="d-block d-sm-none " href="{{ url(app()->getLocale() . '/') }}">
                    <img src="{{ asset('images/Untitled (1).png') }}" alt="Logo" class="mb-logo" loading="lazy">
                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url(app()->getLocale() . '/') }}">@lang('message.home')</a>

                        </li>
<li class="nav-item">
<a class="nav-link active" href="{{ url(app()->getLocale() . '/stores') }}">Stores</a>

</li>
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('categories') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">@lang('message.category')</a>
                            <div class="dropdown-menu mega-menu p-3" aria-labelledby="navbarDropdown">
                                <div class="row">
                                    @foreach ($categories as $category)
                                        <div class="col-md-3">
                                            
                                            <a href="{{ route('related_category', ['lang' => app()->getLocale(), 'slug' => Str::slug($category->slug)]) }}" class="dropdown-item text-dark">{{ $category->title }}</a>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url(app()->getLocale() . '/contact') }}">
                                @lang('message.contact')
                            </a>
                            
                            
                            
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url(app()->getLocale() . '/blog') }}">@lang('message.news')</a>
                        </li>
                    </ul>
                </div>
       

            <!-- Search and Language Selector -->
            <div class="search-language-container">
                <form action="{{ route('storesearch') }}" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="@lang('message.search')" aria-label="Search">
                    <button class="searchbtn" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <li class="nav-item dropdown list-unstyled ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper($currentLang) }}
                    </a>
                    <ul class="dropdown-menu text-center shadow" aria-labelledby="navbarDropdown" style="min-width: auto;">
                        @foreach ($langs as $lang)
                            <li>
                                <a href="{{ url('/' . $lang->code) }}" class="dropdown-item text-dark">
                                    {{ strtoupper($lang->code) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </div>
        </div>
        </nav>
    </header>
<button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fas fa-chevron-up"></i>
    </button>
 <script>
     function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
 </script>
<script>
    // Add event listener for the select dropdown
    document.getElementById('languageSelector').addEventListener('change', function () {
        var selectedLang = this.value;
        var url = `/${selectedLang}`;
        
        // Check if the selected language is "EN" to redirect to the homepage
        if (selectedLang === 'en') {
            url = '/';  // Redirect to the homepage for English
        }

        window.location.href = url;  // Redirect the user to the new URL
    });
    // Scroll-to-top button logic
    let mybutton = document.getElementById("myBtn");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
   
 
</script>


</body>
</html>
