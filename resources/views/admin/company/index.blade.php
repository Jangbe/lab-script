@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Perusahaan','Index'],
        'text_right'=>'<a href="'.route('perusahaan.create').'" class="btn btn-sm btn-neutral">'.__('Create').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Tabel Perusahaan</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="perusahaan_table">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 1%">ID</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat 1</th>
                        <th>Alamat 2</th>
                        <th>Kota</th>
                        <th>Telepon 1</th>
                        <th>Telepon 2</th>
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
    <script src="{{asset('admin/js/company.js')}}"></script>
    <script>
        $(document).on('click','.delete_company',function(e){
            e.preventDefault();
            var el=$(this);
            swal({
                title: "Apakah kamu yakin ingin menghapus perusahaan ini?",
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
    </script>
@endpush
