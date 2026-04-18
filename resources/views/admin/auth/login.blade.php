<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $organisation?->name ? $organisation->name.' Login' : 'Login' }}</title>
     <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />


     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body class="min-vh-100">
    <div class="container-fluid min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-4 col-lg-4 col-xl-3 bg-white p-4 rounded-3">
                <div class="d-flex flex-column justify-content-center">
                    <div class="auth-logo mx-auto pb-3 ">
                        <a href="{{ url('/') }}" class="logo-dark">
                            <img src="{{ $organisation?->logo_url ?: asset('assets/images/gl-logo-dark.png') }}"
                                height="50" alt="logo dark">
                        </a>

                        <a href="{{ url('/') }}" class="logo-light">
                            <img src="{{ $organisation?->logo_url ?: asset('assets/images/gl-logo-dark.png') }}"
                                height="50" alt="logo light">
                        </a>
                    </div>

                    <h2 class="fw-bold fs-24">Sign In</h2>
                    <p class="text-muted mt-1 mb-2">
                        {{ $organisation?->name ? 'Sign in to '.$organisation->name.' dashboard.' : 'Enter your email address or username and password to access admin panel.' }}
                    </p>

                    <div>
                        <div id="login-alert" class="alert d-none" role="alert"></div>

                        <form method="POST" action="{{ $organisation ? route('organisation.login.submit', $organisation) : route('login.submit') }}" class="authentication-form"
                            id="admin-login-form" autocomplete="off">
                            @csrf

                            <div class="">
                                <label class="form-label" for="email">Email/Username</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Enter your email or username" value="{{ old('email') }}">
                                <span class="text-danger small" data-error-for="email"></span>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password-input" class="form-control"
                                        placeholder="Enter your password" style="border-right: none;"
                                        autocomplete="off">
                                    <button type="button" class="btn d-flex align-items-center" id="toggle-password"
                                        aria-label="Show password" style="border:1px solid #d8dfe7; border-left: none;"
                                        autocomplete="off">
                                        <iconify-icon icon="solar:eye-closed-line-duotone" width="18"
                                            height="18"></iconify-icon>
                                    </button>
                                </div>
                                <span class="text-danger small" data-error-for="password"></span>
                            </div>

                            <div class="mb-1 text-center d-grid">
                                <button class="btn btn-primary w-100" type="submit" id="login-submit-btn">Sign
                                    In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <script src="{{ asset('assets/js/vendor.js') }}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('assets/js/app.js') }}"></script>

     <!-- Vector Map Js -->
     <script src="{{ asset('assets/vendor/jsvectormap/jsvectormap.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
     <script src="{{ asset('assets/vendor/jsvectormap/maps/world.js') }}"></script>

     <!-- Dashboard Js -->
     <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('admin-login-form');
            const submitButton = document.getElementById('login-submit-btn');
            const alertBox = document.getElementById('login-alert');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                || form.querySelector('input[name="_token"]')?.value;

            const clearErrors = () => {
                form.querySelectorAll('[data-error-for]').forEach((element) => {
                    element.textContent = '';
                });

                form.querySelectorAll('.error-input-bottom').forEach((element) => {
                    element.classList.remove('error-input-bottom');
                });

                alertBox.className = 'alert d-none';
                alertBox.textContent = '';
            };

            const setFieldError = (field, message) => {
                const input = form.querySelector(`[name="${field}"]`);
                const error = form.querySelector(`[data-error-for="${field}"]`);

                if (input) {
                    input.classList.add('error-input-bottom');
                }

                if (error) {
                    error.textContent = message;
                }
            };

            form.addEventListener('submit', async function(event) {
                event.preventDefault();
                clearErrors();

                submitButton.disabled = true;
                submitButton.textContent = 'Signing In...';

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (response.status === 422 && data.errors) {
                            Object.entries(data.errors).forEach(([field, messages]) => {
                                setFieldError(field, messages[0]);
                            });
                        } else {
                            alertBox.className = 'alert alert-danger';
                            alertBox.textContent = data.message || 'Login failed. Please try again.';
                        }

                        return;
                    }

                    alertBox.className = 'alert alert-success';
                    alertBox.textContent = data.message || 'Login successful.';

                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }

                    window.location.reload();
                } catch (error) {
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'Unable to process login right now. Please try again.';
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Sign In';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const PasswordInput = document.getElementById('password-input');
            const PasswordToggle = document.getElementById('toggle-password');

            if (PasswordInput && PasswordToggle) {
                PasswordToggle.addEventListener('click', function() {
                    const isHidden = PasswordInput.type === 'password';

                    PasswordInput.type = isHidden ? 'text' : 'password';
                    PasswordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                    PasswordToggle.innerHTML = isHidden ?
                        '<iconify-icon icon="solar:eye-line-duotone" width="18" height="18"></iconify-icon>' :
                        '<iconify-icon icon="solar:eye-closed-line-duotone" width="18" height="18"></iconify-icon>';
                });
            }
        });
    </script>
</body>
</html>
