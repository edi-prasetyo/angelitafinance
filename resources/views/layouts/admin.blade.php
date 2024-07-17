<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/fonts/boxicons-2.1.4/css/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/pages/page-auth.css') }}">
    <script src="{{ asset('assets/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/assets/js/config.js') }}"></script>

    {{-- <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    {{-- Custom Calender --}}
    <link rel="stylesheet" href="{{ asset('assets/mc/mc-calendar.min.css') }}">

    {{-- Select2 Bootstrap 5 Css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Scripts -->
    {{-- @livewireStyles --}}

    {{-- Daterange --}}
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/daterange/css/bootstrap-datepicker3.css') }}">


</head>

<body>
    @include('sweetalert::alert')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.inc.admin.sidebar')
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layouts.inc.admin.navbar')
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- build:js assets/vendor/js/core.js -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> --}}
    <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/js/menu.js') }}"></script>
    <!-- Vendors JS -->


    <!-- Main JS -->
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/assets/js/dashboards-analytics.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script> --}}

    {{-- Tambahan --}}
    <script src="{{ asset('assets/assets/vendor/daterange/js/bootstrap-datepicker.js') }}"></script>
    {{-- <script src="{{asset('admin/vendor/autocomplete/jquery-ui.js')}}"></script> --}}
    <link href="{{ asset('assets/summernote/summernote-lite.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/summernote/summernote-lite.js') }}"></script>
    <script src="{{ asset('assets/mc/mc-calendar.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
    </script>

    {{-- Select2 Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
    {{-- @livewireScripts
    @stack('script') --}}
</body>

</html>
