@extends('frontend.layouts.master')

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
                        <h1>Nothing to display right now</h1>
                    </div>
                </div>
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
