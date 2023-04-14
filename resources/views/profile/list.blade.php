@extends('layout.structure')
@include('layout.components')

@section('content')
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center">
          <div class="breadcrumb-title pe-3 text-white">Pages</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="bx bx-home-alt text-white"></i></a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">User Profile</li>
              </ol>
            </nav>
          </div>
        </div>
        <!--end breadcrumb-->

        <div class="profile-cover bg-dark"></div>
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" id="myform" name="myform">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                  <h5 class="mb-0">My Account</h5>
                  <hr>
                  <div class="card shadow-none border">
                    <div class="card-header">
                      <h6 class="mb-0">USER INFORMATION</h6>
                    </div>
                    <div class="card-body">
                        @yield('alert')

                        <div class="row g-3">
                            <div class="col-6">
                               <label class="form-label">Name</label>
                               <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" id="name">
                            </div>
                            <div class="col-6">
                             <label class="form-label">Email address</label>
                             <input type="text" disabled class="form-control" value="{{ Auth::user()->email }}">
                           </div>
                           <div class="col-6">
                            <label class="form-label">Sex</label>
                            <select class="form-select" name="sex" id="sex">
                                <option disabled>--SELECT SEX--</option>
                                <option value="m" {{ Auth::user()->sex == 'm' ? 'selected' : '' }}>Male</option>
                                <option value="f" {{ Auth::user()->sex == 'f' ? 'selected' : '' }}>Female</option>
                              </select>
                        </div>

                        </div>

                    </div>
                  </div>
                  <div class="card shadow-none border">
                    <div class="card-header">
                      <h6 class="mb-0">CONTACT INFORMATION</h6>
                    </div>
                    <div class="card-body">

                        <div class="row g-3">
                             <div class="col-12">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->location }}" name="loc" id="loc">
                               </div>
                        </div>

                    </div>
                  </div>
                  <div class="text-start">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
              <div class="card-body">
                  <div class="profile-avatar text-center">
                    <img src="{{ asset('media/images/avatars/no-image.png') }}" class="rounded-circle shadow" width="120" height="120" alt="">
                  </div>
                  <div class="text-center mt-4">
                    <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                    <p class="mb-0 text-secondary">{{ Auth::user()->location }}</p>
                    <div class="mt-4"></div>
                  </div>
                  <hr>
              </div>
            </div>
          </div>
        </div>
        </form>

@endsection
