<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Geeks N Weebs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-32x32.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="account-body accountbg">

    {{-- Preloader for ajax --}}
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    {{-- Preloader for ajax --}}

    <!-- Recover-pw page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="{{ route('admin.dashboard') }}" class="logo logo-admin">
                                        <img src="assets/images/logo.png" height="50" alt="logo"
                                            class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Reset Password For Geeks N Weebs</h4>
                                    <p class="text-muted  mb-0">Enter your Email and instructions will be sent to you!
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="forgot-form" class="form-horizontal auth-form" action="#">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="username">Email</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="femail"
                                                placeholder="Enter Email" required>
                                        </div>
                                    </div><!--end form-group-->

                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button id="forgot-btn"
                                                class="btn btn-primary w-100 waves-effect waves-light"
                                                type="button">Reset <i class="fas fa-sign-in-alt ms-1"></i></button>
                                        </div><!--end col-->
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                                <p class="text-muted mb-0 mt-3">Remember It ? <a href="{{ route('admin.login-register') }}"
                                        class="text-primary ms-2">Log in here</a></p>
                            </div>
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">{{ config('app.name') }} ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                </span>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Recover-pw page -->




    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        jQuery(function($) {
            // Preloader for ajax request
            $(document).ajaxSend(function() {
                $("#overlay").fadeIn(300);
            });

            //forgot password ajax request
            $("#forgot-btn").click(function(e) {
                if ($("#forgot-form")[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: '/forgot-password',
                        method: 'POST',
                        data: $('#forgot-form').serialize(),
                        success: function(response) {
                            $("#forgot-form")[0].reset();
                            // $("#forgotAlert").html(response);

                            // Show the success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response,
                            });
                        },
                        error: function(response) {
                            // Show the error message
                            var errors = response.responseJSON.errors;
                            var error_message = '';

                            for (var error in errors) {
                                error_message += errors[error] + ' ';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error_message,
                            });
                        }
                    }).always(function() {
                        setTimeout(function() {
                            $("#overlay").fadeOut(
                                300); // Hide the preloader after the request is complete
                        }, 500);
                    });
                } else {
                    $("#forgot-form")[0].reportValidity();
                }
            });


        });
    </script>


</body>



</html>
