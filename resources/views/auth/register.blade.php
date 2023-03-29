@extends('layouts.app')

@section('content')
{{-- <div class="wrapper"> --}}

    <!--start content-->
    {{-- <main class="authentication-content"> --}}
     {{-- <div class="container"> --}}
       {{-- <div class="mt-4"> --}}
         <div class="card rounded-0 overflow-hidden shadow-none bg-white border">
           <div class="row g-0">
             <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
               <img src="{{ asset('media/images/error/auth-img-register3.png') }}" class="img-fluid" alt="">
             </div>
             <div class="col-12 col-xl-4 order-xl-2">
               <div class="card-body p-4 p-sm-5">
                 <h5 class="card-title">Create Account</h5>
                 <p class="card-text mb-4">See your growth and get consulting support!</p>
                 <form method="POST" action="{{ route('register') }}">
                    @csrf
                     <div class="row g-3">
                       <div class="col-12 ">
                         <label for="name" class="form-label">Name</label>
                         <div class="ms-auto position-relative">
                           <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                           <input id="name" type="text" class="form-control radius-30 ps-5 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         </div>
                       </div>
                       <div class="col-12">
                         <label for="email" class="form-label">Email Address</label>
                         <div class="ms-auto position-relative">
                           <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                           <input id="email" type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                           <input id="password" type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         </div>
                       </div>
                       <div class="col-12">
                         <label for="confirm_password" class="form-label">Confirm Password</label>
                         <div class="ms-auto position-relative">
                           <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                           <input id="password-confirm" type="password" class="form-control radius-30 ps-5" name="password_confirmation" required autocomplete="new-password">
                         </div>
                       </div>
                       <div class="col-12">
                         <div class="form-check form-switch">
                           <input class="form-check-input" type="checkbox" id="agree">
                           <label class="form-check-label" for="agree">I Agree to the Terms & Conditions</label>
                         </div>
                       </div>
                       <div class="col-12">
                         <div class="d-grid">
                            <button type="submit" class="btn btn-primary radius-30">
                                {{ __('Register') }}
                            </button>
                         </div>
                       </div>
                       <div class="col-12 text-center">
                         <p class="mb-0">Already have an account? <a href="{{ url('/') }}">Sign in here</a></p>
                       </div>
                     </div>
                 </form>
              </div>
             </div>
           </div>
         </div>
       {{-- </div> --}}
     {{-- </div> --}}
    {{-- </main> --}}

    <!--end page main-->

{{-- </div> --}}
@endsection
