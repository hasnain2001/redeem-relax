<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('{{ asset('images/login1.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .card {
            z-index: 2;
            background: linear-gradient(145deg, #ffffff, #e3e3e3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border: none;
            border-radius: 15px;
        }

        .card-header {
            background: #0066cc;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
            padding: 15px;
        }

        .btn-primary {
            background-color: #0066cc;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004d99;
        }

        .btn-dark {
            background-color: #333;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #000;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card p-4 form-container">
            <div class="card-header">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">Show</button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">Show</button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-dark">Already registered?</a>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const button = input.nextElementSibling;

            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Hide";
            } else {
                input.type = "password";
                button.textContent = "Show";
            }
        }
    </script>
</body>
</html>
