@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pelaksana','Index'],
        'text_right'=>'<a href="'.route('executor.create').'" class="btn btn-sm btn-neutral">'.__('Create').'</a>'
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Tabel Pelaksana</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="executors_table">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 1%">Kode</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Telepon</th>
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
<script src="{{ asset('admin') }}/js/execute.js"></script>
<script>
    //delete executor
    $(document).on('click','.delete_executor',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: "Apakah kamu yakin ingin menghapus pelaksana ini?",
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
