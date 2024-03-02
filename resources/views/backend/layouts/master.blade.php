<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @yield('title')
    </title>
    {{-- Included meta tags --}}
    @include('backend.layouts.partials.meta')
    {{-- Included meta tags --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-32x32.png') }}">

    {{-- Page specific styles cdns --}}
    @yield('page-specific-styles-cdns')
    {{-- Page specific styles cdns --}}

    {{-- Included styles --}}
    @include('backend.layouts.partials.styles')
    {{-- Included styles --}}

</head>

<body class="">

    {{-- Preloader for ajax --}}
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    {{-- Preloader for ajax --}}

    {{-- Included left sidebar --}}
    @include('backend.layouts.partials.left-sidenav')
    {{-- Included left sidebar --}}


    <div class="page-wrapper">
        {{-- Included top bar --}}
        @include('backend.layouts.partials.topbar')
        {{-- Included top bar --}}

        <!-- Page Content-->
        <div class="page-content">
            {{-- page content --}}
            @yield('main-content')
            {{-- page content --}}

            @include('backend.layouts.partials.footer')
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    {{-- Included custom modals --}}
    @yield('custom-modals')
    {{-- Included custom modals --}}

    {{-- Included scripts --}}
    @include('backend.layouts.partials.scripts')
    {{-- Included scripts --}}

    {{-- Page specific scripts cdns --}}
    @yield('page-specific-scripts-cdns')
    {{-- Page specific scripts cdns --}}

    {{-- Included custom scripts --}}
    @yield('custom-scripts')
    {{-- Included custom scripts --}}
</body>
</html>
