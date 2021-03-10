@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Items</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Index</li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('item.create') }}" class="btn btn-sm btn-neutral">Create</a>
                {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                <div class="dropdown">
                    <button class="btn btn-sm btn-neutral dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filter
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                      <button class="dropdown-item filter_status" value="2" type="button">Semua</button>
                      <button class="dropdown-item filter_status" value="1" type="button">Aktif</button>
                      <button class="dropdown-item filter_status" value="0" type="button">Tidak Aktif</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Tabel Items</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="executors_table">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 2%">Kode</th>
                        <th>Pemeriksaan</th>
                        <th>Group</th>
                        <th>Klasifikasi</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="{{ asset('admin') }}/js/item.js"></script>
{{-- <script>
    //delete patient
    $(document).on('click','.delete_executor',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: "Are you sure to delete patient ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if(result.value == true){
                $(el).parent().submit();
            }
        });
    });
</script> --}}
@endpush
