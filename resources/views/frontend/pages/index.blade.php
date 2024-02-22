@extends('frontend.layouts.master')

{{-- title --}}
@section('title')
    {{ config('app.name') }} | Home
@endsection
{{-- title --}}

{{-- main content --}}
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20" class="me-1">
                        <h5 class="me-auto my-0">Geeks N Weebs</h5>
                        <small>Just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Hello, {{ Auth::user()->name }}
                    </div>
                </div><!--end toast-->
            </div> <!-- end col -->
        </div>
    </div>
@endsection
{{-- main content --}}

{{-- page-specific-scripts-cdns --}}
@section('page-specific-scripts-cdns')
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
@endsection
{{-- page-specific-scripts-cdns --}}

{{-- custom-scripts --}}
@section('custom-scripts')
    <script>
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ $errors->first() }}";
        // session messages
        $(document).ready(function() {
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
    </script>
@endsection
{{-- custom-scripts --}}
