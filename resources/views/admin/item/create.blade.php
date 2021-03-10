@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Item</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Item</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('item.index') }}" class="btn btn-sm btn-neutral">Kembali</a>
                <a href="#" class="btn btn-sm btn-neutral">Filters</a>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Tambah Pelaksana')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('item.store') }}">
                            @include('admin.item._form')
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">{{__('Tambahkan')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#items').addClass('active');
    </script>
@endpush
