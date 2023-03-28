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

    <title>{{ env('APP_NAME') }}</title>
</head>

<body class="bg-forgot-password">

    <!--start wrapper-->
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
                                    <p class="card-text mb-5">Enter your registered email ID to reset the password</p>
                                    <form class="form-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputEmailid" class="form-label">Email id</label>
                                                <input type="email" class="form-control form-control-lg radius-30"
                                                    id="inputEmailid" placeholder="Email id">
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid gap-3">
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary radius-30">Send</button>
                                                    <a href="{{ url('/') }}"
                                                        class="btn btn-lg btn-light radius-30">Back to Login</a>
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
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{ asset('media/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('media/js/pace.min.js') }}"></script> --}}


</body>

</html>