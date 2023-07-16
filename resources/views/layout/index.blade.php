<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js')
    <title>SIASAH Ponorogo | @yield('title')</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/css/adminlte.min.css">
    @stack('css')

</head>

<body class="sidebar-mini layout-navbar-fixed layout-footer-fixed layout-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link font-weight-bolder">Sistem Informasi Pelayanan Pengganti Ijasah
                        Hilang</a>
                </li>
                <li class="nav-item d-xs-block d-sm-none d-md-none d-sm-inline-block">
                    <a href="" class="nav-link font-weight-bolder">SIASAH Kabupaten Ponorogo</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">



                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-light-orange elevation-4">
            <a href="#" class="brand-link navbar-primary">
                <img src="{{ asset('asset') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-normal">SIASAH Ponorogo</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('asset') }}/img/user.jfif" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                @include('sweetalert::alert')
                @if (auth()->user()->role == 'administrator')
                    @include('layout.v_nav_superadmin')
                @elseif(auth()->user()->role == 'operator')
                    @include('layout.v_nav')
                @endif
            </div>
        </aside>

        <div class="content-wrapper w">
            <div class="content-header">

            </div>
            @yield('content')

        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <footer class="main-footer">
            <strong>SISTEM INFORMASI PELAYANAN PENGGANTI IJASAH YANG HILANG &copy; 2023.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>

    <script src="{{ asset('asset') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset') }}/js/adminlte.js"></script>

    @stack('java')
</body>

</html>
