@extends('layouts.app')

@section('content')
    {{-- @include('layouts.headers.cards') --}}
    <!-- Header -->
    <div class="header bg-gradient-primary pb-6 pt-md-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Maps</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Maps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Maps</li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-6 col-5 text-right">
                <a href="#" class="btn btn-sm btn-neutral">New</a>
                <a href="#" class="btn btn-sm btn-neutral">Filters</a>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
          <div class="col">
            <div class="card border-0">
              <div id="map-default" class="map-canvas" data-lat="40.748817" data-lng="-73.985428" style="height: 600px;"></div>
            </div>
          </div>
        </div>
        @include('layouts.footers.guest')
      </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdHNgL9kB6PvdGLy1dmWG4jG8w8580IBc"></script>
@endpush
