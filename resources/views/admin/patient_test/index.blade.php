@extends('layouts.app')

@section('text_right')
    @can('create_pemeriksaan_pasien')
    <a href="{{route('patient_test.create')}}" class="btn btn-sm btn-neutral">{{__('Create')}}</a>
    @endcan
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pasien Test','Index']
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Tabel Pasien Test</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="patients_table">
                    <thead class="thead-light">
                      <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>No Identitas</th>
                        <th>No Telepon</th>
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
<script src="{{ asset('admin') }}/js/patient_test.js"></script>
<script>
    //delete patient
    $(document).on('click','.delete_patient',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: "Apakah kamu yakin ingin menghapus pasien ini?",
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
