<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Complain Entry | Sundarban Courier Service (Pvt.) Ltd.</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
@yield('css')
<style>
    @media print {
       .no-print {
          display: none;
       }
    }
    </style>
<style>
    .password-toggle {
    cursor: pointer;
}
</style>
<body>
    <div id="app">
   

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }} "></script>

<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#password-toggle').click(function() {
            const passwordField = $('#password');
            const passwordToggleIcon = $('#password-toggle i');
    
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                passwordToggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                passwordToggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
    </script>
    @yield('js')
</html>
