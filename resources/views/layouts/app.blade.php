<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.2.0" rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
        <style type="text/css">
            .preloader {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              z-index: 9999;
              background-color: #fff;
            }
            .preloader .loading {
              position: absolute;
              left: 50%;
              top: 50%;
              transform: translate(-50%,-50%);
              font: 14px arial;
            }
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        <div class="preloader">
            <div class="loading">
              <img src="{{asset('assets/img/icons/loader.gif')}}" width="80">
              <p>Harap Tunggu</p>
            </div>
        </div>

        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>

        <!-- DataTables -->
        <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/jszip/jszip.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <!-- Toastr-->
        <script src="{{ asset('assets/vendor/toastr/toastr.min.js')}}"></script>

        <!-- SweetAlert2 -->
        <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/select2/dist/js/select2.full.min.js') }}"></script>

        <!-- Argon JS -->
        <script src="{{ asset('assets') }}/js/argon.js?v=1.2.0"></script>

        <script>
            var stop_loader = true;
        </script>

        @stack('js')
        <!-- Flash messages -->
        <script>
            //intialize toastr
            toastr.options = {
                "debug": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "fadeIn": 300,
                "fadeOut": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000
            }
            @if(session()->has('success'))
            toastr.success("{{Session::get('success')}}");
            @endif
            @if(Session()->has('failed'))
            toastr.error("{{Session::get('failed')}}");
            @endif

            $(document).ready(function(){
                if(stop_loader){
                    $('.preloader').fadeOut();
                }
            });
        </script>

    </body>
</html>
