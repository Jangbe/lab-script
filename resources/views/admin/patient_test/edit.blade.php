@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pasien Test','Edit'],
        'text_right'=>'<a href="'.route('patient_test.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Edit Pendaftaran Pasien')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('patient_registration.update', $patientRegistration['no_pendaftaran']) }}">
                            @method('put')
                            @include('admin.patient_test._form')
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">{{__('Update')}}</button>
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
        set_executors('../../');

        $('input[name=sts_pengunjung]').parent().parent().parent().hide();
        $('.lama').hide();
        $.ajax({
            url: "",
            success: async function(result){
                await ajax_wilayah('kd_kota',result.patient.kd_provinsi,'regencies','kota', false);

                await ajax_wilayah('kd_kecamatan',result.patient.kd_kota,'districts','kecamatan', false);

                await ajax_wilayah('kd_kelurahan',result.patient.kd_kecamatan,'villages','kelurahan', false);

                for(let i=1;i<=result.patient_test.length;i++){
                    await set_form_test(i,'../../');
                }

                for(let i=1;i<=result.patient_test.length;i++){
                    $(`#id_item_${i}`).val(result.patient_test[i-1].id_item);
                    $(`#id_pelaksana_${i}`).val(result.patient_test[i-1].id_pelaksana);
                    $(`#no_alat_${i}`).val(result.patient_test[i-1].no_alat);
                    $(`#non_jaminan_${i}`).attr('checked',result.patient_test[i-1].non_jaminan==1);
                    $(`#harga_${i}`).val(result.patient_test[i-1].harga);
                }

                let rrk = result.patient.rt_rw_kodepos!=null?result.patient.rt_rw_kodepos.split('-'):['','',''];

                $('#rt').val(rrk[0]);
                $('#rw').val(rrk[1]);
                $('#kodepos').val(rrk[2]);

                $('#'+result.patient.jenis_kelamin).attr('checked', true);

                $('#umur').val(calculate_age(new Date(result.patient.tanggal_lahir))+' tahun');

                for(i in result.patient){
                    $('#'+i).val(result.patient[i]);
                }

                for(i in result){
                    $('#'+i).val(result[i]);
                }

                $('input[name=sts_pengunjung]').val(result.sts_pengunjung);

                $('#noreg').attr('disabled',true);
            }
        })

        $(document).on('change','.item', function(){
            let id = $(this).find(':selected').val();
            let harga=0;
            $.ajax({
                url: '../../item_tarif/'+id,
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
            set_form_test(id,'../../');
        });
    </script>
@endpush
