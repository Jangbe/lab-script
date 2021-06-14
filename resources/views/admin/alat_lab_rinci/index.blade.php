@extends('layouts.app')

@section('text_right')
    @can('create_parameter_alat_lab')
        <button id="create" class="btn btn-sm btn-neutral">{{__('Create')}}</button>
    @endcan
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Tipe','index'],
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tabel Alat Laboratorium Rinci')}}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="hasil_lab_tipe_table">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 2%">{{__('ID')}}</th>
                                <th>{{__('Nama Alat')}}</th>
                                <th>{{__('Parameter')}}</th>
                                <th>{{__('Nilai')}}</th>
                                <th>{{__('Tipe Nilai')}}</th>
                                <th>{{__('Satuan')}}</th>
                                <th class="text-center">{{__('Aksi')}}</th>
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

    @can('create_parameter_alat_lab')
        @include('admin.alat_lab_rinci._modal')
    @endcan
@endsection
@push('js')
    <script src="{{asset('admin/js/alat_lab_rinci.js')}}"></script>
    <script>
        $('#create').click(function(){
            $('#id_alat').val(0);
            $('#parameter').val('');
            $('#tipe_nilai').val('');
            $('#nilai').val('');
            $('#satuan').val('');
            $('input[name=_method]').val('post');
            $('#form').attr('action', "{{route('alat_lab_rinci.store')}}");
            $('#alatLabLabel').text('Buat Parameter Alat Lab Baru');
            $('#alatLab').modal('show');
        });

        $(document).on('click','.edit',function(){
            var id_alat = $(this).data('id');
            $.ajax({
                url: "alat_lab_rinci/"+id_alat,
                success:function(result){
                    $('#id_alat').val(result.id_alat);
                    $('#parameter').val(result.parameter);
                    $('#tipe_nilai').val(result.tipe_nilai);;
                    $('#nilai').val(result.nilai);
                    $('#satuan').val(result.satuan);
                    $('input[name=_method]').val('patch');
                    $('#form').attr('action', "alat_lab_rinci/"+id_alat);
                    $('#alatLabLabel').text('Edit Parameter Alat Lab '+result.alat_lab.nm_alat);
                    $('#alatLab').modal('show');
                }
            })
        });

        $(document).on('click','.delete_item',function(e){
            e.preventDefault();
            var el=$(this);
            swal({
                title: "Apakah kamu yakin ingin menghapus parameter alat ini?",
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
