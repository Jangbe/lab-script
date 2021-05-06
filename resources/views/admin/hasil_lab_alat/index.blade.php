@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Tipe','index'],
        'text_right'=>'<button id="create" class="btn btn-sm btn-neutral">'.__('Create').'</button>'
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
                                {{-- <th style="width: 2%">{{__('ID')}}</th> --}}
                                <th>{{__('Nama Hasil')}}</th>
                                <th>{{__('Parameter Alat')}}</th>
                                <th>{{__('Pembagi')}}</th>
                                <th>{{__('Pengali')}}</th>
                                <th>{{__('Koma')}}</th>
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

    @include('admin.hasil_lab_alat._modal')
@endsection
@push('js')
    <script src="{{asset('admin/js/hasil_lab_alat.js')}}"></script>
    <script>
        $('#create').click(function(){
            $('#id_hasil_lab').val(0);
            $('#id_alat_lab_rinci').val(0);
            $('#nilai_pembagi').val('');
            $('#nilai_pengali').val('');
            $('#jumlah_koma').val('');
            $('input[name=_method]').val('post');
            $('#form').attr('action', "{{route('hasil_lab_alat.store')}}");
            $('#alatLabLabel').text('Buat Parameter Alat Lab Baru');
            $('#alatLab').modal('show');
        });

        $(document).on('click','.edit',function(){
            var id_alat = $(this).data('id');
            $.ajax({
                url: "hasil_lab_alat/"+id_alat,
                success:function(result){
                    $('#id_hasil_lab').val(result.id_hasil_lab);
                    $('#id_alat_lab_rinci').val(result.id_alat_lab_rinci);
                    $('#nilai_pembagi').val(result.nilai_pembagi);;
                    $('#nilai_pengali').val(result.nilai_pengali);
                    $('#jumlah_koma').val(result.jumlah_koma);
                    $('input[name=_method]').val('patch');
                    $('#form').attr('action', "hasil_lab_alat/"+id_alat);
                    $('#alatLabLabel').text('Setting Hasil Alat Lab '+result.nm_alat);
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
