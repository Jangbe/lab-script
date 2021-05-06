@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Tipe','index'],
        'text_right'=>'<button id="create" class="btn btn-sm btn-neutral">'.__('Create').'</button>
            <div class="dropdown">
                <button class="btn btn-sm btn-neutral dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.__('Filter').'
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item filter_status" value="2" type="button">'.__('Semua').'</button>
                  <button class="dropdown-item filter_status" value="1" type="button">'.__('Aktif').'</button>
                  <button class="dropdown-item filter_status" value="0" type="button">'.__('Tidak Aktif').'</button>
                </div>
            </div>'
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tabel Alat Laboratorium')}}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="hasil_lab_tipe_table">
                    <thead class="thead-light">
                        <tr>
                        <th style="width: 2%">{{__('ID')}}</th>
                        <th>{{__('Nama Alat')}}</th>
                        <th>{{__('Uraian')}}</th>
                        <th class="text-center">{{__('Aktif')}}</th>
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

    @include('admin.alat_labs._modal')
    @include('admin.alat_labs._modal_detail')
@endsection
@push('js')
    <script src="{{asset('admin/js/alat_lab.js')}}"></script>
    <script>
        $('#create').click(function(){
            $('#nm_alat').val('');
            $('#uraian').val('');
            $('#is_active').attr('checked',false);
            $('#com').val('');
            $('#timeout').val('');
            $('#buffer').val('');
            $('#baudrate').val('');
            $('#databits').val('');
            $('#parity').val('');
            $('#stopbits').val('');
            $('#timer').val('');
            $('input[name=_method]').val('post');
            $('#form').attr('action', "{{route('alat_lab.store')}}");
            $('#alatLabLabel').text('Buat Alat Lab Baru');
            $('#alatLab').modal('show');
        });

        $(document).on('click','.edit_tipe',function(){
            var id_alat = $(this).data('id');
            $.ajax({
                url: "alat_lab/"+id_alat,
                success:function(result){
                    $('#nm_alat').val(result.nm_alat);
                    $('#uraian').val(result.uraian);
                    $('#is_active').attr('checked',result.is_active==1);
                    $('#com').val(result.com);
                    $('#timeout').val(result.timeout);
                    $('#buffer').val(result.buffer);
                    $('#baudrate').val(result.baudrate);
                    $('#databits').val(result.databits);
                    $('#parity').val(result.parity);
                    $('#stopbits').val(result.stopbits);
                    $('#timer').val(result.timer);
                    $('input[name=_method]').val('patch');
                    $('#form').attr('action', "alat_lab/"+id_alat);
                    $('#alatLabLabel').text('Edit Alat Lab '+result.nm_alat);
                    $('#alatLab').modal('show');
                }
            })
        });

        $(document).on('click','.detail',function(){
            let id_alat = $(this).data('id');
            $.ajax({
                url: 'alat_lab/'+id_alat,
                success: function(result){
                    $('#alatLabDetailLabel').text('Detail Alat Lab '+result.nm_alat);
                    for(i in result){
                        if(i!='is_active'){
                            $('#d_'+i).text(result[i]);
                        }
                    }
                    $('#d_is_active').html(is_true(result.is_active));
                    $('#alatLabDetail').modal('show');
                }
            })
        });

        $(document).on('click','.delete_item',function(e){
            e.preventDefault();
            var el=$(this);
            swal({
                title: "Apakah kamu yakin ingin menghapus alat ini?",
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
