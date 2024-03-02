<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo-large" class="" width="50">
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            {{-- <li class="menu-label mt-0">Main</li> --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"><i data-feather="layers"
                        class="align-self-center menu-icon"></i><span>Dashboard</span></a>
            </li>
            {{-- <li>
                <a href="javascript: void(0);"> <i data-feather="home"
                        class="align-self-center menu-icon"></i><span>Dashboard</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i
                                class="ti-control-record"></i>Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="sales-index.html"><i
                                class="ti-control-record"></i>Sales</a></li>
                </ul>
            </li> --}}

            {{-- Tasks --}}
            <li>
                <a href="javascript: void(0);"><i data-feather="grid"
                        class="align-self-center menu-icon"></i><span>Tasks</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="#"><i
                                class="ti-control-record"></i>All Tasks</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i
                                class="ti-control-record"></i>Add New</a></li>
                </ul>
            </li>
            {{-- Tasks --}}


            {{-- Posts --}}
            <li>
                <a href="javascript: void(0);"><i data-feather="grid"
                        class="align-self-center menu-icon"></i><span>Posts</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts') }}"><i
                                class="ti-control-record"></i>All Posts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.add_new_post') }}"><i
                                class="ti-control-record"></i>Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i
                                class="ti-control-record"></i>Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i
                                class="ti-control-record"></i>Tags</a></li>
                </ul>
            </li>
            {{-- Posts --}}

            {{-- Comments --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"><i data-feather="layers"
                        class="align-self-center menu-icon"></i><span>Comments</span></a>
            </li>
            {{-- Comments --}}

            
        </ul>

    </div>
</div>
<!-- end left-sidenav-->