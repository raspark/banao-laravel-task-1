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


    <!-- Log In page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="{{ route('admin.dashboard') }}" class="logo logo-admin">
                                        <img src="{{ asset('assets/images/logo.png') }}" height="50" alt="logo"
                                            class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Let's Get Started Geeks N Weebs
                                    </h4>
                                    <p class="text-muted  mb-0">Sign in to continue to Geeks N Weebs.</p>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav-border nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#LogIn_Tab"
                                            role="tab">Log In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#Register_Tab"
                                            role="tab">Register</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                        <form id="login-form" class="form-horizontal auth-form" action="#">
                                            @csrf

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="email"
                                                        id="email" placeholder="Enter email"
                                                        value="{{ \Cookie::get('email', '') }}" required>
                                                </div>
                                            </div><!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="Enter password" required
                                                        minlength="8">
                                                </div>
                                            </div><!--end form-group-->

                                            <div class="form-group row my-3">
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-switch switch-success">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchSuccess" name="rem"
                                                            {{ \Cookie::get('email') ? 'checked' : '' }}>
                                                        <label class="form-label text-muted"
                                                            for="customSwitchSuccess">Remember me</label>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-sm-6 text-end">
                                                    <a href="{{ route('admin.forgot_password') }}"
                                                        class="text-muted font-13"><i class="dripicons-lock"></i> Forgot
                                                        password?</a>
                                                </div><!--end col-->
                                            </div><!--end form-group-->

                                            {{-- Alert Msg --}}
                                            <div id="loginAlertMsg" class="text-danger"></div>

                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button id="login-btn"
                                                        class="btn btn-primary w-100 waves-effect waves-light"
                                                        type="button">Log In <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div><!--end col-->
                                            </div> <!--end form-group-->
                                        </form><!--end form-->
                                        <div class="m-3 text-center text-muted">
                                            <p class="mb-0">Don't have an account ? <a href="auth-register"
                                                    class="text-primary ms-2">Register now</a></p>
                                        </div>
                                        <div class="account-social">
                                            <h6 class="mb-3">Or Login With</h6>
                                        </div>
                                        <div class="btn-group w-100">
                                            <a href="{{ route('admin.social.login', 'google') }}"
                                                class="btn btn-sm btn-outline-secondary"><img
                                                    src="{{ asset('assets/images/icons8-google-48.png') }}"
                                                    width="25" alt=""><span
                                                    class="">Google</span></a>
                                            <a href="{{ route('admin.social.login', 'github') }}"
                                                class="btn btn-sm btn-outline-secondary"><img
                                                    src="{{ asset('assets/images/icons8-github-48.png') }}"
                                                    width="25" alt=""><span
                                                    class="">Github</span></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane px-3 pt-3" id="Register_Tab" role="tabpanel">
                                        <form id="register-form" class="form-horizontal auth-form" action="#">
                                            @csrf

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="name">Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter name" required>
                                                </div>
                                            </div><!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Enter email">
                                                </div>
                                            </div><!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        id="rpassword" placeholder="Enter password" minlength="8"
                                                        required>
                                                </div>
                                            </div><!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="conf_password">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" id="cpassword"
                                                        placeholder="Enter Confirm Password" minlength="8" required>
                                                </div>
                                            </div><!--end form-group-->

                                            {{-- Password not match error --}}
                                            <div class="form-group mb-2">
                                                <div id="passError" class="text-danger font-weight-bolder"></div>
                                            </div>

                                            {{-- Alert Msg --}}
                                            <div id="regAlertMsg" class="text-danger"></div>

                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button id="register-btn"
                                                        class="btn btn-primary w-100 waves-effect waves-light"
                                                        type="button">Register <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div><!--end col-->
                                            </div> <!--end form-group-->
                                        </form><!--end form-->
                                        <p class="my-3 text-muted">Already have an account ?<a href="auth-login"
                                                class="text-primary ms-2">Log in</a></p>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body bg-light-alt d-flex justify-content-between">
                                <span class="text-muted d-none d-sm-inline-block">Geeks N Weebs ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                </span>
                                <span class="text-muted d-none d-sm-inline-block">
                                    Icons by <a target="_blank" href="https://icons8.com">Icons8</a>
                                </span>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Log In page -->




    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        // session messages
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "{{ session('success') }}";
            var errorMessage = "{{ $errors->first() }}";

            // success message
            if (successMessage) {
                Swal.fire({
                    title: "Success!",
                    text: successMessage,
                    icon: "success"
                });
            }

            // error message
            if (errorMessage) {
                Swal.fire({
                    title: "Error!",
                    text: errorMessage,
                    icon: "error"
                });
            }
        });

        jQuery(function($) {
            // Preloader for ajax request
            $(document).ajaxSend(function() {
                $("#overlay").fadeIn(300);
            });

            // When the "Log in" link is clicked
            $('a[href="auth-login"]').click(function(e) {
                e.preventDefault(); // Prevent the default action

                // Trigger click on the "Log In" tab
                $('a[href="#LogIn_Tab"]').tab('show');
            });

            // When the "Free Register" link is clicked
            $('a[href="auth-register"]').click(function(e) {
                e.preventDefault(); // Prevent the default action

                // Trigger click on the "Register" tab
                $('a[href="#Register_Tab"]').tab('show');
            });

            //Register Ajax request
            $("#register-btn").click(function(e) {
                if ($("#register-form")[0].checkValidity()) {
                    e.preventDefault();
                    if ($("#rpassword").val() != $("#cpassword").val()) {
                        $("#passError").text('* Password did not matched!');
                    } else {
                        $("#passError").text('');
                        $.ajax({
                            url: '{{ route('admin.register') }}',
                            method: 'POST',
                            data: $('#register-form').serialize(),
                            success: function(response) {
                                // If the registration was successful, redirect the user to the home page
                                if (response === 'register') {
                                    window.location = '{{ route('admin.dashboard') }}';
                                } else {
                                    // If the registration was not successful, display the error -- here I can use custom error message with custom responses
                                    $("#regAlertMsg").html(response);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // If validation fails, the server will respond with a 422 status code
                                if (jqXHR.status === 422) {
                                    // Clear the previous errors
                                    $("#regAlertMsg").html('');
                                    // Get the errors from the response
                                    var errors = jqXHR.responseJSON.errors;

                                    // Loop through each error and display it
                                    $.each(errors, function(key, value) {
                                        $("#regAlertMsg").append('<p>' + value +
                                            '</p>');
                                    });
                                } else {
                                    // If the server responds with a status code other than 422
                                    $("#regAlertMsg").html(
                                        'An error occurred while processing your request. Please try again.'
                                    );
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
                    $("#register-form")[0].reportValidity();
                }
            });

            //login ajax request
            $("#login-btn").click(function(e) {
                if ($("#login-form")[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('admin.login') }}',
                        method: 'POST',
                        data: $("#login-form").serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                // Redirect to the home page
                                window.location.href = response.redirect;
                            } else {
                                $("#loginAlertMsg").html(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // If validation fails, the server will respond with a 422 status code
                            if (jqXHR.status === 422) {
                                // Clear the previous errors
                                $("#loginAlertMsg").html('');
                                // Get the errors from the response
                                var errors = jqXHR.responseJSON.errors;

                                // Loop through each error and display it
                                $.each(errors, function(key, value) {
                                    $("#loginAlertMsg").append('<p>' + value + '</p>');
                                });
                            }
                            // Using auth attempt method in controller that returns 401 status code 
                            else if (jqXHR.status === 401) {
                                // Display the server's error message
                                $("#loginAlertMsg").html(jqXHR.responseText);
                            } else {
                                // Set the button text back to normal
                                $("#login-btn").val('Log In');
                                // If the server responds with a status code other than 422 or 401
                                $("#loginAlertMsg").html(
                                    'An error occurred while processing your request. Please try again.'
                                );
                            }
                        }
                    }).always(function() {
                        setTimeout(function() {
                            $("#overlay").fadeOut(
                                300); // Hide the preloader after the request is complete
                        }, 500);
                    });
                } else {
                    $("#login-form")[0].reportValidity();
                }
            });



        });
    </script>


</body>


</html>
