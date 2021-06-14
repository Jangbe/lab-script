<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Argon Dashboard') }}</title> --}}
        <title>{{setting('identitas','nama')}}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {display:none;}

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
        @yield('css')
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

        {{-- Chart JS --}}
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

        <!-- Argon JS -->
        <script src="{{ asset('assets') }}/js/argon.js?v=1.2.0"></script>

        <script>
            function formated_price(x, separator='.',abs=true) {
                if(separator==''){
                    return x.toString().replace(/\./g, '');
                }else{
                    if(abs){
                        x=Math.abs(x);
                    }
                    var parts = x.toString().split(",");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, separator);
                    return parts.join(".");
                }
            }
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
                if($.active<1){
                    $('.preloader').fadeOut();
                }
                $(document).ajaxStop(function(){
                    $('.preloader').fadeOut();
                })
            });
        </script>

    </body>
</html>
