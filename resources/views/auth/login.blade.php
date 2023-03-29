@extends('layouts.app')

@section('content')
{{-- <div class="wrapper"> --}}

    <!--start content-->
    {{-- <main class="authentication-content"> --}}
     <div class="container">
       <div class="mt-4">
         <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
           <div class="row g-0">
             <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
               <img src="{{ asset('media/images/error/auth-img-7.png') }}" class="img-fluid" alt="">
             </div>
             <div class="col-12 col-xl-4 order-xl-2">
               <div class="card-body p-4 p-sm-5">
                 <h5 class="card-title">Sign In</h5>
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
                       {{-- <div class="col-12">
                         <div class="login-separater text-center"> <span>OR SIGN IN WITH EMAIL</span>
                           <hr>
                         </div>
                       </div>
                       <div class="col-12">
                         <div class="d-flex align-items-center gap-3 justify-content-center">
                           <button type="button" class="btn btn-white text-danger"><i class="bi bi-google me-0"></i></button>
                           <button type="button" class="btn btn-white text-primary"><i class="bi bi-linkedin me-0"></i></button>
                           <button type="button" class="btn btn-white text-info"><i class="bi bi-facebook me-0"></i></button>
                         </div>
                       </div> --}}
                       <div class="col-12 text-center">
                        @if (Route::has('register'))

                        <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </p>
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
    {{-- </main> --}}

    <!--end page main-->

{{-- </div> --}}
@endsection
