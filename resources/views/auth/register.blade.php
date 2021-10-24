@extends('layouts.app')

@section('title', 'Register | Bake N Flake')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-card">
                <div class="card-body d-flex justify-content-around m-5">
                    <div class="col-md-6 auth-desgin">
                        <img src="images/auth/signup.jpg" alt="" width="100%" height="100%">
                    </div>
                    <div class="col-md-6 m-5">
                        <form method="POST" action="{{ route('register') }}" id="register-form">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input  id="name"
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror input"
                                            name="name"
                                            placeholder="Enter your name"
                                            value="{{ old('name') }}"
                                            autocomplete="name"
                                            autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input  id="email"
                                            type="email"
                                            class="form-control @error('email') is-invalid @enderror input"
                                            name="email"
                                            placeholder="Enter your email"
                                            value="{{ old('email') }}"
                                            autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input  id="mobile_no"
                                            type="number"
                                            class="form-control @error('mobile_no') is-invalid @enderror input"
                                            name="mobile_no"
                                            placeholder="Enter your mobile no."
                                            value="{{ old('mobile_no') }}"
                                            autocomplete="mobile_no">

                                    @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input  id="address"
                                            type="address"
                                            class="form-control @error('address') is-invalid @enderror input"
                                            name="address"
                                            placeholder="Enter your address"
                                            value="{{ old('address') }}"
                                            autocomplete="address">

                                    @error('address')
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
                                            class="form-control @error('password') is-invalid @enderror input"
                                            name="password"
                                            placeholder="Enter your password"
                                            autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input  id="password-confirm"
                                            type="password"
                                            class="form-control input"
                                            name="password_confirmation"
                                            placeholder="Confirm your password"
                                            autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div>
                                        <button type="submit" class="btn  my-register-button">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        @if (Route::has('password.request'))
                                            <strong class="">Already have an account?</strong>
                                            <a class="btn btn-link p-0 ml-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        @endif
                                    </div>
                                </div>
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
        $("#register-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    myPasswordPattern: true
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    myPasswordPattern: true,
                    equalTo: "#password"
                },
                mobile_no: {
                    required: true,
                    digits: true,
                    exactlength: 10
                },
                address: {
                    required: true,
                    maxlength:255
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
        $.validator.addMethod('myPasswordPattern', function(value, element) {
            return this.optional(element) || (value.match(/[a-z]/) && value.match(/[0-9]/ && value.match(/[A-Z]/)));
        },
        'Password must contain at least one numeric, one capital and one small character.');

        jQuery.validator.addMethod("exactlength", function(value, element, param) {
            return this.optional(element) || value.length == param;
        }, $.validator.format("Please enter exactly {0} characters."));

    </script>
@endsection
