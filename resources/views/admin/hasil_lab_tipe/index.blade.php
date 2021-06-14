@extends('layouts.app')

@section('text_right')
    @can('create_hasil_lab_tipe')
        <button id="create" class="btn btn-sm btn-neutral">{{__('Create')}}</button>
    @endcan
    <div class="dropdown">
        <button class="btn btn-sm btn-neutral dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{__('Filter')}}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item filter_status" value="2" type="button">{{__('Semua')}}</button>
            <button class="dropdown-item filter_status" value="1" type="button">{{__('Number')}}</button>
            <button class="dropdown-item filter_status" value="0" type="button">{{__('Teks')}}</button>
        </div>
    </div>
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Tipe','index']
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tabel Hasil Tipe')}}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="hasil_lab_tipe_table">
                    <thead class="thead-light">
                        <tr>
                        <th style="width: 2%">{{__('ID')}}</th>
                        <th>{{__('Keterangan')}}</th>
                        <th class="text-center">{{__('Number')}}</th>
                        <th>{{__('Aksi')}}</th>
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

    @can('create_hasil_lab_tipe')
    @include('admin.hasil_lab_tipe.modal')
    @endcan
@endsection
@push('js')
    <script src="{{asset('admin/js/hasil_lab_tipe.js')}}"></script>
    <script>
        $(document).on('click','.edit_tipe',function(){
            var id_tipe = $(this).data('id');
            $.ajax({
                url: "hasil_lab_tipe/"+id_tipe,
                success:function(result){
                    $('#keterangan').val(result.keterangan);
                    $('#is_number').attr('checked',result.is_number==1);
                    $('input[name=_method]').val('patch');
                    $('#form').attr('action', "hasil_lab_tipe/"+id_tipe);
                    $('#hslLabTipeLabel').text('Edit Hasil Lab Tipe '+result.keterangan);
                    $('#hslLabTipe').modal('show');
                }
            })
        });

        $(document).on('click','.delete_item',function(e){
            e.preventDefault();
            var el=$(this);
            swal({
                title: "Apakah kamu yakin ingin menghapus hasil lab tipe ini?",
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

        $('#create').click(function(){
            $('input[name=_method]').val('post');
            $('#keterangan').val('');
            $('#is_number').attr('checked',false);
            $('#form').attr('action', "{{route('hasil_lab_tipe.store')}}");
            $('#hslLabTipeLabel').text('Buat Hasil Lab Tipe');
            $('#hslLabTipe').modal('show');
        });
    </script>
@endpush
