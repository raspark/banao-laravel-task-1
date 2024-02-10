<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Geeks N Weebs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
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
                                    <a href="{{ route('home') }}" class="logo logo-admin">
                                        <img src="{{ asset('assets/images/logo.png') }}" height="50" alt="logo"
                                            class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Reset Password For Geeks N
                                        Weebs</h4>
                                    <p class="text-muted  mb-0">Enter your new password!!
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="reset-pass-form" class="form-horizontal auth-form" action="#">
                                    @csrf
                                    {{-- Email and Token for further checking --}}
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="form-group mb-2">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="rpassword"
                                                placeholder="Password" required minlength="8">
                                        </div>
                                    </div><!--end form-group-->

                                    <div class="form-group mb-2">
                                        <label class="form-label" for="password">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="cpassword" placeholder="Confirm assword" required minlength="8">
                                        </div>
                                    </div><!--end form-group-->

                                    <div class="form-group mb-2">
                                        <div id="passError" class="text-danger font-weight-bolder"></div>
                                    </div><!--end form-group-->

                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button id="reset-pass-btn"
                                                class="btn btn-primary w-100 waves-effect waves-light"
                                                type="button">Reset Password<i
                                                    class="fas fa-sign-in-alt ms-1"></i></button>
                                        </div><!--end col-->
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                                <p class="text-muted mb-0 mt-3">Remember It ? <a href="{{ route('login-register') }}"
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

            //Update Password Ajax request
            $("#reset-pass-btn").click(function(e) {
                if ($("#reset-pass-form")[0].checkValidity()) {
                    e.preventDefault();
                    if ($("#rpassword").val() != $("#cpassword").val()) {
                        $("#passError").text('* Password did not matched!');
                    } else {
                        $("#passError").text('');
                        $.ajax({
                            url: '/password/update',
                            method: 'POST',
                            data: $('#reset-pass-form').serialize(),
                            success: function(response) {
                                // console.log(response);
                                // If the password update was successful, redirect the user to the login page
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Password Reset Successful',
                                        text: response.success,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location = '/login-register';
                                        }
                                    });
                                } else {
                                    // If the password update was not successful, display the error
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'An error occurred while processing your request. Please try again.',
                                        icon: 'error'
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // If validation fails, the server will respond with a 422 status code
                                if (jqXHR.status === 422) {
                                    // Get the errors from the response
                                    var errors = jqXHR.responseJSON.errors;
                                    var errorMessages = '';

                                    // Loop through each error and add it to the errorMessages string
                                    $.each(errors, function(key, value) {
                                        errorMessages += value + '\n';
                                    });

                                    // Display the errors using SweetAlert
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error! Please Try Later',
                                        text: errorMessages
                                    });
                                } else {
                                    // If the server responds with a status code other than 422
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while processing your request. Please try again.'
                                    });
                                }
                            }
                        }).always(function() {
                            setTimeout(function() {
                                $("#overlay").fadeOut(
                                    300
                                ); // Hide the preloader after the request is complete
                            }, 500);
                        });
                    }
                } else {
                    $("#reset-pass-form")[0].reportValidity();
                }
            });


        });
    </script>


</body>



</html>
