@extends('layouts.app')

@section('headerlinks')
<link rel="stylesheet" href="{{ asset('media/css/login/login.css') }}">
<style>
    .xxaa{
        /* width: 100%;
    height: 100vh; */
    background-image: url("{{ asset('media/images/error/auth-img-7.png') }}");
    background-repeat: no-repeat;
    background-size: cover;
    /* border: 2px solid #e9385a; */
    }
</style>
@endsection

@section('content')
<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="{{ asset('media/images/brand-logo-2.png') }}" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
            <p class="card-text mb-4">See your growth and get consulting support!</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                 <div class="row g-3">
                   <div class="col-12">
                     <label for="email" class="form-label">Email Address</label>
                     <div class="ms-auto position-relative">
                       <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                       <input id="email" type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                     </div>
                   </div>
                   <div class="col-12">
                     <label for="password" class="form-label">Enter Password</label>
                     <div class="ms-auto position-relative">
                       <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                       <input id="password" type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                     </div>
                   </div>
                   <div class="col-12">
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                     </div>
                   </div>
                   <div class="col-12 text-start">
                    @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                   </div>
                   <div class="col-12">
                     <div class="d-grid">
                        <button type="submit" class="btn btn-primary radius-30">
                            {{ __('Login') }}
                        </button>
                     </div>
                   </div>
                   <div class="col-12 text-center">
                    @if (Route::has('register'))

                    <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </p>
                @endif
                   </div>
                 </div>
             </form>
            {{--  --}}
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block xxaa">
          {{-- <img src="{{ asset('media/images/error/auth-img-7.png') }}" alt="login image" class="login-img"> --}}
        </div>
      </div>
    </div>
  </main>
@endsection
