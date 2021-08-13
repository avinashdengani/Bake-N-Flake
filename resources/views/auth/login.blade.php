@extends('layouts.app')

@section('title', 'Login | Bake N Flake')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card my-card">
                <div class="card-body  d-flex  p-5">
                    <div class="col-md-8 auth-desgin">
                        <img src="images/auth/login.jpg" alt="" width="100%" height="100%">
                    </div>
                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <div class="col-md-5">
                            <img src="images/auth/login-user.jpg" alt="" class="ml-5 mb-1" width="150px" height="150px">
                        </div>
                        <div>
                            <form method="POST" action="{{ route('login') }}" id="login-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input  id="email"
                                                type="email"
                                                placeholder="Enter your email"
                                                class="form-control @error('email') is-invalid @enderror input"
                                                name="email"
                                                value="{{ old('email') }}"
                                                autocomplete="email"
                                                autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input  id="password"
                                                type="password"
                                                placeholder="Enter your password"
                                                class="form-control @error('password') is-invalid @enderror input"
                                                name="password"
                                                autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember" style="user-select: none">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <div >
                                            <button type="submit" class="btn my-login-button">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link p-0 m-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
            },
            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });
    </script>
@endsection
