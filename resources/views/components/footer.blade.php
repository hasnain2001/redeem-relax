<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="{{ asset('cssfile/footer.css') }}">
</head>
<body>
    <br>
    <footer>
        <div class="footer-container">
            <div class="col-md-1  col-sm-2text-center">
                <a href="{{ url(app()->getLocale() . '/') }}">
                    <img src="{{ asset('images/Untitled (1).png') }}" class="footerimg " alt="Logo">
                </a>
            </div>

            <div class="col-md-8 offset-md-1 ">
                <div class="footer-right">
                    <div class="social-icons">
                        <p class="subscribe mt-2">@lang('message.Subscribe to our Newsletter')</p>
                        <form class="mt-2">
                            @csrf
                            <div class="input-group">
                                
                                <input type="text" name="email" class="form-control" placeholder="@lang('message.Enter Your Email')" required>
                                <button type="submit" class="subscribehbtn">@lang('message.Subscribe ')</button>
                            </div>
                        </form>
                    </div>

<div class="footer-links">
    <a href="{{url(app()->getLocale() . '/about') }}">@lang('message.About-Us')</a>

    <a href="{{ url(app()->getLocale() . '/privacy') }}">@lang('message.Privacy Policy') </a>
    <a href="{{ url(app()->getLocale() . '/terms-and-condition') }}">@lang('message.Terms and Condition')</a>
    {{-- <a href="{{ url(app()->getLocale() . '/cookies')  }}">@lang('message.Cookies Policy')</a> --}}
    <a href="{{ url(app()->getLocale() . '/imprint')  }}">@lang('message.Imprint')</a>
</div>
                    <p>@lang('message.Copyright &copy; 2024 redeemrelax.com - All rights reserved')</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
