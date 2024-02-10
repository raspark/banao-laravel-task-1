@extends('frontend.layouts.master')

{{-- title --}}
@section('title')
    {{ config('app.name') }} | Profile
@endsection
{{-- title --}}

{{-- main content --}}
@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card rounded-0 mt-3 border-primary">
                    <div class="card-header border-primary">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Change
                                    Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- profile tab content start  -->
                            <div class="tab-pane container active" id="profile">
                                <div class="card-deck">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-light text-center lead">
                                            User ID : {{ $user->id ?? '' }}
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name
                                                    :</b> {{ $user->name ?? '' }}</p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail
                                                    :</b> {{ $user->email ?? '' }}</p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Gender
                                                    :</b> {{ Str::ucfirst($user->gender) ?? '' }}</p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Date
                                                    of Birth :</b> {{ $user->dob ?? '' }}</p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Phone
                                                    :</b> {{ $user->phone ?? '' }}</p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                                <b>Registered On :</b> {{ $user->created_at ?? '' }}
                                            </p>
                                            <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail
                                                    verified :</b> {{ $user->email_verified_at ?? '' }}
                                                @if ($user->email_verified_at == null)
                                                    <a href="#" class="float-right">Verify Now</a>
                                                @endif
                                            </p>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="card border-primary align-self-center">
                                        @if ($user->photo == null)
                                            <img src="{{ asset('assets/images/avatar.webp') }}"
                                                class="img-fluid img-thumbnail" width="408px">
                                        @else
                                            <img src="{{ Storage::url($user->photo) }}" class="img-fluid img-thumbnail"
                                                width="408px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- profile tab content end  -->
                            <!-- edit profile tab content start  -->
                            <div class="tab-pane container fade" id="editProfile">
                                <div class="card-deck">
                                    <div class="card border-danger align-self-center">
                                        @if ($user->photo == null)
                                            <img src="{{ asset('assets/images/avatar.webp') }}"
                                                class="img-fluid img-thumbnail" width="408px">
                                        @else
                                            <img src="{{ Storage::url($user->photo) }}" class="img-fluid img-thumbnail"
                                                width="408px">
                                        @endif
                                    </div>
                                    <div class="card border-danger">
                                        <form action="{{ route('profile.update') }}" method="post"
                                            id="profile-update-form" class="px-3 mt-2" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group m-0">
                                                <label for="photo" class="m-1">Upload profile image</label>
                                                <input type="file" name="photo" id="photo">
                                            </div>

                                            <div class="form-group m-0">
                                                <label for="name" class="m-1">Name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $user->name ?? '' }}">
                                            </div>

                                            <div class="form-group m-0">
                                                <label for="gender" class="m-1">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="" disabled
                                                        {{ $user->gender == null ? 'selected' : '' }}>Select Gender
                                                    </option>
                                                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                        Male
                                                    </option>
                                                    <option value="female"
                                                        {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>

                                            <div class="form-group m-0">
                                                <label for="dob" class="m-1">Date of Birth</label>
                                                <input type="date" name="dob" id="dob"
                                                    value="{{ $cdob ?? '' }}" class="form-control">
                                            </div>

                                            <div class="form-group m-0">
                                                <label for="phone" class="m-1">Phone</label>
                                                <input type="tel" name="phone" id="phone"
                                                    value="{{ $cphone ?? '' }}" class="form-control"
                                                    placeholder="+91XXXXXXXXXX">
                                            </div>

                                            <div class="form-group mt-2">
                                                <input type="submit" name="profile_update" id="profileUpdateBtn"
                                                    class="btn btn-danger btn-block" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- edit profile tab content end  -->

                            <!-- change Password tab content start -->
                            <div class="tab-pane container fade" id="changePass">
                                <div class="card-deck">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white text-center lead">
                                            Change Password
                                        </div>
                                        <form action="{{ route("change_password") }}" method="post" class="px-3 mt-2">
                                            @csrf
                                            <div class="form-group">
                                                <label for="curpass">Enter your current password</label>
                                                <input type="password" name="curpass" id="curpass"
                                                    placeholder="Current password" class="form-control form-control-lg"
                                                    required minlength="5">
                                            </div>
                                            <div class="form-group">
                                                <label for="newpass">Enter new password</label>
                                                <input type="password" name="newpass" id="newpass"
                                                    placeholder="New password" class="form-control form-control-lg"
                                                    required minlength="5">
                                            </div>
                                            <div class="form-group">
                                                <label for="newpass_confirmation">Enter new password</label>
                                                <input type="password" name="newpass_confirmation" id="newpass_confirmation"
                                                    placeholder="Confirm new password"
                                                    class="form-control form-control-lg" required minlength="5">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" name="changepass" id="changePassBtn"
                                                    value="Change Password" class="btn btn-success btn-block btn-lg">
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card border-success align-self-center">
                                        <img src="{{ asset('assets/images/changePassImg.webp') }}"
                                            class="img-fluid img-thumbnail" width="408px">
                                    </div>
                                </div>
                            </div>
                            <!-- change Password tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- main content --}}

{{-- custom-scripts --}}
@section('custom-scripts')
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
    </script>
@endsection
{{-- custom-scripts --}}
