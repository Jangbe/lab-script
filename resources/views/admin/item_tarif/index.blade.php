@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Item Tarif','Index'],
        'text_right'=>'<div class="dropdown">
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
              <h3 class="mb-0">{{__('Tabel Item Tarif')}}</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="executors_table">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 2%">{{__('Pemeriksaan')}}</th>
                        <th>{{__('Tarif Dasar')}}</th>
                        <th>{{__('Tarif BPJS')}}</th>
                        <th>{{__('Tarif Jaminan')}}</th>
                        <th>{{__('Tanggal Berlaku')}}</th>
                        <th>{{__('Aktif')}}</th>
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
        @include('admin.item_tarif._modal');
    </div>
@endsection

@push('js')
<script src="{{ asset('admin') }}/js/item_tarif.js"></script>
<script>
    $(document).on('click','.edit_tarif',function(){
        let id_item = $(this).data('id');
        $.ajax({
            url: "item_tarif/"+id_item,
            success: function(result){
                $('#form').attr('action', 'item_tarif/'+result.id_item);
                $('#id_item').val(result.id_item);
                $('#tarif_bayar').val(result.tarif_bayar);
                $('#tarif_bpjs').val(result.tarif_bpjs);
                $('#tarif_jaminan').val(result.tarif_jaminan);
                $('#tanggal_berlaku').val(result.tanggal_berlaku);
                $('#is_active').attr('checked',(result.is_active==1));
                $('#itemTarif').modal('show');
            }
        })
    })
</script>
@endpush
