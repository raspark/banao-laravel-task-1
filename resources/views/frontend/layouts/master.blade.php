<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @yield('title')
    </title>
    {{-- Included meta tags --}}
    @include('frontend.layouts.partials.meta')
    {{-- Included meta tags --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-32x32.png') }}">

    {{-- Page specific styles cdns --}}
    @yield('page-specific-styles-cdns')
    {{-- Page specific styles cdns --}}

    {{-- Included styles --}}
    @include('frontend.layouts.partials.styles')
    {{-- Included styles --}}

</head>

<body class="">
    {{-- Included left sidebar --}}
    @include('frontend.layouts.partials.left-sidenav')
    {{-- Included left sidebar --}}


    <div class="page-wrapper">
        {{-- Included top bar --}}
        @include('frontend.layouts.partials.topbar')
        {{-- Included top bar --}}

        <!-- Page Content-->
        <div class="page-content">
            {{-- page content --}}
            @yield('main-content')
            {{-- page content --}}

            @include('frontend.layouts.partials.footer')
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    {{-- Included custom modals --}}
    @yield('custom-modals')
    {{-- Included custom modals --}}

    {{-- Included scripts --}}
    @include('frontend.layouts.partials.scripts')
    {{-- Included scripts --}}

    {{-- Page specific scripts cdns --}}
    @yield('page-specific-scripts-cdns')
    {{-- Page specific scripts cdns --}}

    {{-- Included custom scripts --}}
    @yield('custom-scripts')
    {{-- Included custom scripts --}}
</body>
</html>
