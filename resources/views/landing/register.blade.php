<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('media/images/favicon.png') }}" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{ asset('media/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/bootstrap-extended.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/icons.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="{{ asset('media/css/pace.min.css') }}" rel="stylesheet" />

  <title>{{ env("APP_NAME") }}</title>
</head>

<body class="bg-surface">

  <!--start wrapper-->
  <div class="wrapper">

       <!--start content-->
       {{-- <main class="authentication-content"> --}}
        <div class="container">
          <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none bg-white border">
              <div class="row g-0">
                <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                  <img src="{{ asset('media/images/error/auth-img-register3.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-4 order-xl-2">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign Up</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                     <form class="form-body">

                        <div class="row g-3">
                          <div class="col-12 ">
                            <label for="inputName" class="form-label">Name</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                              <input type="email" class="form-control radius-30 ps-5" id="inputName" placeholder="Enter Name">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Password">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                              <label class="form-check-label" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <a class="btn btn-primary radius-30" href="{{ url('/home') }}">Sign Up</a>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="login-separater text-center"> <span>OR SIGN UP WITH EMAIL</span>
                              <hr>
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
          </div>
        </div>
       {{-- </main> --}}

       <!--end page main-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{ asset('media/js/bootstrap.bundle.min.js') }}"></script>

  <!--plugins-->
  <script src="{{ asset('media/js/jquery.min.js') }}"></script>
  <script src="{{ asset('media/js/pace.min.js') }}"></script>


</body>

</html>
