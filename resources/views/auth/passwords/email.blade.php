@extends('layouts.app')

@section('title', 'Forgot Password | Bake N Flake')
@section('favico', asset('../images/favico.ico'))
@section('logo-img', asset('../images/logo/logo.jpg'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-card">
                <div class="card-body d-flex justify-content-around m-5">
                    <div class="col-md-6 auth-desgin">
                        <img src="../images/auth/forgot.jpg" alt="" width="100%" height="100%">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    <form method="POST" action="{{ route('password.email') }}" id="forgot-password-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input  id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror input-100"
                                        name="email"
                                        placeholder="Enter your email"
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn  my-send-password-link-button">
                                    {{ __('Send Password Reset Link') }}
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
        $("#forgot-password-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
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
    </script>
@endsection
