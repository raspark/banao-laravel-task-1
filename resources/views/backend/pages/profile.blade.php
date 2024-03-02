@extends('backend.layouts.master')

{{-- title --}}
@section('title')
    {{ config('app.name') }} | Profile
@endsection
{{-- title --}}

{{-- main content --}}
@section('main-content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Profile</h4>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-body p-0">
                        <div id="user_map" class="pro-map" style="height: 220px"></div>
                    </div><!--end card-body--> --}}
                    <div class="card-body">
                        <div class="dastone-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                    <div class="dastone-profile-main">
                                        <div class="dastone-profile-main-pic">
                                            <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : Auth::user()->avatar ?? asset('assets/images/avatar.webp') }}"
                                                alt="" height="110" class="rounded-circle">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                            <form id="profileForm" action="{{ route('admin.profile.update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" id="fileInput" name="photo" style="display: none;">
                                            </form>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">{{ Auth::user()->name }}</h5>
                                            <p class="mb-0 dastone-user-name-post">{{ Auth::user()->tagline }}</p>
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i
                                                class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone
                                            </b> : {{ Auth::user()->phone }}</li>
                                        <li class="mt-2"><i
                                                class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email
                                            </b> : {{ Auth::user()->email }}</li>
                                    </ul>

                                </div><!--end col-->

                                <div class="col-lg-4 mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <p class="mb-0 fw-semibold">About</p>
                                            <span class="text-muted font-12 fw-normal">{{ Auth::user()->about }}</span>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end f_profile-->
                    </div><!--end card-body-->
                </div> <!--end card-->
            </div><!--end col-->
        </div><!--end row-->
        <div class="pb-4">
            <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="connections_tab" data-bs-toggle="pill" href="#connections">Connections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="portfolio_detail_tab" data-bs-toggle="pill"
                        href="#Profile_Portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="settings_detail_tab" data-bs-toggle="pill" href="#Profile_Settings">Settings</a>
                </li>
            </ul>
        </div><!--end card-body-->
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade " id="connections" role="tabpanel" aria-labelledby="connections_tab">
                        <p>Coming soon</p>
                    </div><!--end tab-pane-->
                    <div class="tab-pane fade" id="Profile_Post" role="tabpanel"
                        aria-labelledby="Profile_Post_tab">
                        <p>Coming soon</p>
                    </div>
                    <div class="tab-pane fade" id="Profile_Portfolio" role="tabpanel"
                        aria-labelledby="portfolio_detail_tab">
                        <p>Coming soon</p>
                    </div>
                    <div class="tab-pane fade show active" id="Profile_Settings" role="tabpanel"
                        aria-labelledby="settings_detail_tab">
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="card-title">Personal Information</h4>
                                            </div><!--end col-->
                                        </div> <!--end row-->
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <form action="{{ route('admin.profile.update') }}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="name">
                                                    Name</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input name="name" id="name" class="form-control"
                                                        type="text" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="tagline">
                                                    Tagline</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input name="tagline" id="tagline" class="form-control"
                                                        type="text" value="{{ Auth::user()->tagline }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="about">
                                                    About</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <textarea name="about" rows="3" id="about" class="form-control">{{ Auth::user()->about }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="phone">Contact
                                                    Phone</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="las la-phone"></i></span>
                                                        <input name="phone" id="phone" type="text"
                                                            class="form-control" value="{{ Auth::user()->phone }}"
                                                            placeholder="Phone" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="email">Email
                                                    Address</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="las la-at"></i></span>
                                                        <input type="text" class="form-control"
                                                            value="{{ Auth::user()->email }}" placeholder="Email"
                                                            aria-describedby="basic-addon1" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="dob">Date of Birth</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="la la-calendar"></i></span>
                                                        <input type="date" name="dob" id="dob"
                                                            class="form-control" value="{{ Auth::user()->dob }}"
                                                            placeholder="" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center"
                                                    for="gender">Gender</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <select name="gender" id="gender" class="form-select">
                                                        <option value="" disabled
                                                            {{ $user->gender == null ? 'selected' : '' }}>Select Gender
                                                        </option>
                                                        <option value="male"
                                                            {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                            {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                        <option value="other"
                                                            {{ $user->gender == 'other' ? 'selected' : '' }}>
                                                            Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-primary">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!--end col-->
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Change Password</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <form action="{{ route('admin.change_password') }}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Current
                                                    Password</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input class="form-control" name="curpass" id="curpass" type="password" placeholder="Password">
                                                    <a href="{{ route('admin.forgot_password') }}"
                                                        class="text-primary font-12">Forgot password ?</a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New
                                                    Password</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input class="form-control" name="newpass" id="newpass"
                                                        type="password" placeholder="New Password" required minlength="8">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm
                                                    Password</label>
                                                <div class="col-lg-9 col-xl-8">
                                                    <input class="form-control" name="newpass_confirmation"
                                                        id="newpass_confirmation" type="password"
                                                        placeholder="Re-Password" required minlength="8">
                                                    <span class="form-text text-muted font-12">Never share your
                                                        password.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Change
                                                        Password</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Other Settings</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Email_Notifications" checked>
                                            <label class="form-check-label" for="Email_Notifications">
                                                Email Notifications
                                            </label>
                                            <span class="form-text text-muted font-12 mt-0">Do you need them?</span>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="API_Access">
                                            <label class="form-check-label" for="API_Access">
                                                API Access
                                            </label>
                                            <span class="form-text text-muted font-12 mt-0">Enable/Disable access</span>
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!-- end col -->
                        </div><!--end row-->
                    </div><!--end tab-pane-->
                </div><!--end tab-content-->
            </div><!--end col-->
        </div><!--end row-->

    </div>
@endsection
{{-- main content --}}

{{-- custom modals --}}
@section('custom-modals')
    {{-- Modal --}}
    {{-- <div id="previewModal" class="modal">
        <div class="modal-content">
            
        </div>
    </div> --}}

    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Picture Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <img id="previewImage" src="" alt="Image preview" height="210" class="rounded-circle">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveButton" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection
{{-- custom modals --}}

{{-- custom-scripts --}}
@section('custom-scripts')
    <script>
        // session messages
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "{{ session('success') }}";
            var errorMessage = "{{ $errors->first() }}";

            // success message
            if (successMessage) {
                Swal.mixin({
                    toast: !0,
                    position: "top-end",
                    showConfirmButton: !1,
                    timer: 3e3,
                    timerProgressBar: !0,
                    onOpen: function(t) {
                        t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener(
                            "mouseleave",
                            Swal.resumeTimer)
                    }
                }).fire({
                    icon: "success",
                    title: successMessage,
                })
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
            // profile image change
            $(".dastone-profile_main-pic-change").click(function() {
                $("#fileInput").click();
            });

            $("#fileInput").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Show the image preview in the modal
                        $('#previewImage').attr('src', e.target.result);
                        // Show the modal
                        $('#previewModal').modal('show');
                    }

                    reader.readAsDataURL(this.files[0]); // convert to base64 string
                }
            });

            // Submit the form when the save button is clicked
            $("#saveButton").click(function() {
                $("#profileForm").submit();
                // Clear the file input's value
                $("#fileInput").val('');
            });

            // Clear the file input's value when the modal is closed
            $('#previewModal').on('hidden.bs.modal', function() {
                $("#fileInput").val('');
            });
        });
    </script>
@endsection
{{-- custom-scripts --}}
