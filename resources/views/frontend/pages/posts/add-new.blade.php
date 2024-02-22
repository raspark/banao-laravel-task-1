@extends('frontend.layouts.master')

{{-- title --}}
@section('title')
    {{ config('app.name') }} | Profile
@endsection
{{-- title --}}

{{-- page-specific-styles-cdns --}}
@section('page-specific-styles-cdns')
    {{-- dropify --}}
    <link href="{{ asset('plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

    <!-- summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    {{-- summernote css/js --}}

    {{-- DatePicker --}}
    <!-- Plugins css -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    {{-- DatePicker --}}
@endsection
{{-- page-specific-styles-cdns --}}

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
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dastone</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="day-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i data-feather="download" class="align-self-center icon-xs"></i>
                            </a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Post Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Keep it blank to auto generate">
                                </div>

                                <div class="col-12">
                                    <label for="your-message" class="form-label">Your Message</label>
                                    <textarea id="summernote" class="form-control" name="editordata"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Post Featured Image</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" id="input-file-now" class="dropify" data-height="83" />
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->

                                <div class="col-md-6">
                                    <label for="your-subject" class="form-label">Post Meta Description</label>
                                    <textarea class="form-control" name="" id="" cols="" rows="6"></textarea>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            
                                        </div>
                                        <div class="col-md-3 d-flex g-3">
                                            <button type="submit" class="btn btn-dark fw-bold w-100">Publish Now</button>
                                            <label class="form-label">Publish Later</label>
                                            <input type="text" id="date-format" class="form-control"
                                                placeholder="Select Date and Time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->



    </div>
@endsection
{{-- main content --}}

{{-- custom modals --}}
@section('custom-modals')

    {{-- End Modal --}}
@endsection
{{-- custom modals --}}

{{--  --}}
@section('page-specific-scripts-cdns')
    {{-- dropify --}}
    <script src="{{ asset('plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-upload.init.js') }}"></script>
    {{-- summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {{-- DatePicker --}}
    <!-- Plugins js -->
      
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/huebee/huebee.pkgd.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.forms-advanced.js') }}"></script>
    {{-- DatePicker --}}
@endsection
{{--  --}}

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
            // summernote
            $('#summernote').summernote({
                height: 300,
                fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48', '64', '82', '150'],
            });
            $('.dropdown-toggle').dropdown();
            // summernote


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
