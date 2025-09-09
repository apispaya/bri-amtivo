@extends('layouts.auth')

@section('title', 'Login')

@section('css')
@endsection

@section('main_content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                                    src="../assets/images/logo/logo_crop.png" style="height: 95px" alt="looginpage"><img
                                    class="img-fluid for-dark" src="../assets/images/logo/logo_crop.png"
                                    style="height: 95px" alt="looginpage"></a></div>
                        <div class="login-main">
                            @include('partials.error')
                            <form class="theme-form" method="POST" action="{{ route('login.perform') }}" novalidate>
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group"><label class="col-form-label">Email Address</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                        value="{{ old('email') }}" required autocomplete="username" autofocus
                                        placeholder="you@example.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" id="password" type="password" name="password" required
                                            autocomplete="current-password" placeholder="********">
                                        <div class="show-hide" role="button" tabindex="0"
                                            aria-label="Show or hide password">
                                            <span class="show"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="form-check">
                                        <input class="checkbox-primary form-check-input" id="remember" type="checkbox"
                                            name="remember">
                                        <label class="text-muted form-check-label" for="remember">Remember me</label>
                                    </div>
                                    <div class="text-end"><button class="btn btn-primary btn-block w-100 mt-3"
                                            type="submit">Login</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.show-hide');
            if (!toggle) return;

            const input = toggle.closest('.form-input')?.querySelector('input');
            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                toggle.querySelector('span')?.classList.remove('show'); // let your theme switch the icon
                toggle.setAttribute('aria-pressed', 'true');
            } else {
                input.type = 'password';
                toggle.querySelector('span')?.classList.add('show');
                toggle.setAttribute('aria-pressed', 'false');
            }
        });

        // keyboard accessibility (space/enter)
        document.addEventListener('keydown', function(e) {
            if ((e.key === 'Enter' || e.key === ' ') && e.target.closest('.show-hide')) {
                e.preventDefault();
                e.target.click();
            }
        });
    </script>
@endsection
