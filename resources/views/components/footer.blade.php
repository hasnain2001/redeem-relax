<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        footer {
            background-color: rgb(116, 31, 161);
            color: white;
            padding: 40px 0;
        }

        .footer-section a {
            color: white;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-made-by a {
            color: white;
            text-decoration: none;
        }

        .footer-made-by a:hover {
            color: #ddd;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<footer>
  <div class="container">
    <div class="row text-center text-md-start">
      <!-- Logo and About Us -->
      <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
        <a class="navbar-brand d-block mb-3" href="/">
          <img src="{{ asset('front/assets/images/logo-footer.jpg') }}" width="150" alt="Honeycombdeals Logo">
        </a>
        <p>Welcome to Honeycombdeals! Discover deals, promo codes, comparisons, and money-saving insights for savvy shoppers.</p>
        <a href="{{ url('about') }}" class="btn btn-link text-white p-0">About Us</a>
      </div>

      <!-- Privacy Policy and Terms -->
      <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-3">Policies</h5>
        <ul>
          <li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
          <li><a href="{{ url('term-and-condition') }}">Terms and Conditions</a></li>
        </ul>
      </div>

      <!-- Contact Us -->
      <div class="col-md-4 col-sm-6">
        <h5 class="text-uppercase mb-3">Contact Us</h5>
        <ul>
          <li><a href="mailto:honeycombdeal@gmail.com">honeycombdeal@gmail.com</a></li>
          <li><a href="mailto:contact@honeycombdeals.com">contact@honeycombdeals.com</a></li>
        </ul>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="row mt-4 pt-4 border-top">
      <div class="col text-center">
        <p class="mb-0">&copy; 2024 Honeycombdeals. All Rights Reserved.</p>
        <p class="mt-2"><a href="#" target="_blank" class="text-white">Developed by O.B.M TECH</a></p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script>
  $(document).ready(function() {
    $('#searchInput').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '{{ route("search") }}',
                dataType: 'json',
                data: {
                    query: request.term
                },
                success: function(data) {
                    response(data.stores);
                }
            });
        },
        minLength:1 
    });
  });
</script>
</body>
</html>
