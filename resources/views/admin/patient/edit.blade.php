@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pelaksana','Edit'],
        'text_right'=>'<a href="'.route('patient.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Edit Pelaksana')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('patient.update', $patient->id) }}">
                            @method('put')
                            @include('admin.patient._form')
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">{{__('Update')}}</button>
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
    <script src="{{ asset('admin') }}/js/patient.js"></script>
    <script>
        $.ajax({
            url: "",
            success: async function(result){
                await ajax_wilayah('kd_kota',result.kd_provinsi,'regencies','kota', false);

                await ajax_wilayah('kd_kecamatan',result.kd_kota,'districts','kecamatan', false);

                await ajax_wilayah('kd_kelurahan',result.kd_kecamatan,'villages','kelurahan', false);

                let rrk = result.rt_rw_kodepos!=null?result.rt_rw_kodepos.split('-'):['','',''];
                $('#rt').val(rrk[0]);
                $('#rw').val(rrk[1]);
                $('#kodepos').val(rrk[2]);

                $('#'+result.jenis_kelamin).attr('checked', true);

                $('#umur').val(diff_years(new Date, new Date(result.tanggal_lahir))+' tahun');

                for(i in result){
                    $('#'+i).val(result[i]);
                }

                $('#noreg').attr('disabled',true);

                $('.preloader').fadeOut();
            }
        })
    </script>
@endpush
