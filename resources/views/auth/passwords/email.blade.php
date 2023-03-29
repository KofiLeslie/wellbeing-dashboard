@extends('layouts.app')

@section('content')
<div class="wrapper">

    <!--start content-->
    <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-5 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                            <img src="https://img.freepik.com/free-vector/man-thinking-concept-illustration_114360-7990.jpg?w=740&t=st=1662791646~exp=1662792246~hmac=a0cee1f7c7f898b2b47bfafc0c477f3f0ef9151e3488056c41b74ae4a3e6acb9"
                                class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Forgot Password?</h5>
                                <p class="card-text">Enter your registered email to reset the password</p>
                                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                {{-- <label for="email">{{ __('Email Address') }}</label> --}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autofocus placeholder="Enter e-mail">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary radius-30">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                             </div>
                            {{-- <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="mb-0"><a href="{{ url('/') }}">Back to Login</a></p>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!--end page main-->

</div>
@endsection
