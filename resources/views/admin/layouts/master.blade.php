<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('admin.includes.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('admin.includes.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    @include('admin.includes.sidebar')

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{-- breadcrumb --}}
            @yield('header-content')
            {{-- breadcrumb --}}

            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                
                   @yield('main-content')
               
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('admin.includes.footer')
    <!-- END: Footer-->

    <!-- BEGIN: Scripts-->
    @include('admin.includes.script')
    <!-- END: Scripts-->


</body>
<!-- END: Body-->

</html>
