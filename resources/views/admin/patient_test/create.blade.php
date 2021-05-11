@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pasien Test','Tambah'],
        'text_right'=>'<a href="'.route('patient_test.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div id="showTime"></div>
                        {{__('Pendaftaran Test Pasien')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('patient_test.store') }}">
                            @include('admin.patient_test._form')
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">{{__('Tambahkan')}}</button>
                                </div>
                                <div class="form-group total col-3">
                                    <input type="text" class="form-control" readonly placeholder="Total Harga" id="subtotal" name="subtotal">
                                </div>
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
    <script src="{{ asset('admin') }}/js/patient_test.js"></script>
    <script>
        set_executors('../');

        $.ajax({
            url: '../get_no_pendaftaran',
            success: function(no){
                $('#no_pendaftaran').val(no);
            }
        })

        // Pemilihan pasien lama
        $.ajax({
            url: '../patient',
            success: function({data}){
                data.forEach(v=>{
                    $('#s_no_rm').append(`<option value="${v.id}">${v.noreg}</option>`);
                    $('#s_nama').append(`<option value="${v.id}">${v.nama}</option>`);
                })
            }
        })

        // $('#s_no_rm').select2();
        // $('#s_nama').select2();

        $('#s_no_rm').change(function(){
            set_form_patient($(this).val());
        });
        $('#s_nama').change(function(){
            set_form_patient($(this).val());
        });

        $('.baru').show();
        $('.lama').hide();
        let list_blocked = ['hub','no_rm','nama','tempat_lahir','tanggal_lahir','status',
                            'gol_darah','alamat1','alamat2','rt','rw','kodepos','id_perusahaan',
                            'kd_provinsi','kd_kota','kd_kecamatan','kd_kelurahan','no_identitas','no_telepon'
                        ];
        $('input[name=sts_pengunjung').change(function(){
            let sts_pengunjung = $(this).val();
            if(sts_pengunjung=='L'){
                $('.lama').show();
                $('.baru').hide();
                list_blocked.forEach((v,k)=>{
                    $('#'+v).attr('disabled',true);
                });
                $('input[name=jenis_kelamin]').attr('disabled',true);
            }else{
                $('.baru').show();
                $('.lama').hide();
                list_blocked.forEach((v,k)=>{
                    $('#'+v).attr('disabled',false);
                    $('#'+v).val('');
                });
                $('#umur').val('');
                $('input[name=jenis_kelamin]').attr('disabled',false);
            }
        });

        $(document).on('change','.item', function(){
            let id = $(this).find(':selected').val();
            let harga=0;
            $.ajax({
                url: '../item_tarif/'+id,
                async: false,
                success: ({tarif_bayar})=>{
                    harga=tarif_bayar;
                }
            }).catch(e=>{});
            $(this).parent().next().next().next().next().children()[1].value=harga;
            let total_harga = $('.harga_total');
            let tot=0;
            total_harga.each((k,v)=>{
                tot+=parseInt(v.value);
            })
            $('#subtotal').val(tot);
        })

        $('#tambah').click(function(){
            let id = $('.list-pemeriksaan').children().length + 1;
            set_form_test(id);
        });
    </script>
@endpush
