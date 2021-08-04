@extends('layouts.app')

@section('title', 'Reset Password | Bake N Flake')
@section('favico', asset('../../images/favico.ico'))
@section('logo-img', asset('../../images/logo/logo.jpg'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-card">
                <div class="card-body d-flex justify-content-around m-5">
                    <div class="col-md-6 auth-desgin">
                        <img src="{{asset('../images/auth/reset.jpg')}}" alt="" width="100%" height="100%">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <div>
                            <form method="POST" action="{{ route('password.update') }}" id="reset-password-form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input  id="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror input"
                                                name="email"
                                                placeholder="email"
                                                value="{{ $email ?? old('email') }}"
                                                required
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
                                                class="form-control @error('password') is-invalid @enderror input"
                                                name="password"
                                                placeholder="Enter new password"
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
                                        <input id="password-confirm"
                                               type="password"
                                               class="form-control input"
                                               name="password_confirmation"
                                               placeholder="Confirm new password"
                                               autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 ">
                                        <button type="submit" class="btn my-reset-password-button">
                                            {{ __('Reset Password') }}
                                        </button>
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
        $("#reset-password-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
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
                }
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

    </script>
@endsection
