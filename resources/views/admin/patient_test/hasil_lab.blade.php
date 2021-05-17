@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pasien Test','Tambah'],
        'text_right'=>
            '<a href="'.route('pdf.hasil_lab',$patientTest['no_pendaftaran']).'" target="_blank" class="btn btn-sm btn-neutral">'.__('Cetak').'</a>
            <a href="'.route('patient_test.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div id="showTime"></div>
                        {{__('Informasi Pasien')}}
                        <a class="close" data-toggle="collapse" href="#informasiPasien" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="ni ni-bold-down"></i>
                            <i class="ni ni-bold-right d-none"></i>
                        </a>
                    </div>
                    <div class="card-body collapse show" id="informasiPasien">
                        {{-- For patient registration --}}
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-row mb-2">
                                    <label for="no_pendaftaran" class="col-5 col-form-label col-form-label-sm">No Pendaftaran</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="no_pendaftaran" value="{{$patientTest['no_pendaftaran']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="tanggal_daftar" class="col-5 col-form-label col-form-label-sm">Tanggal Daftar</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="tanggal_daftar" value="{{date('d-m-Y h:i',strtotime($patientTest['created_at']))}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="cara_bayar" class="col-5 col-form-label col-form-label-sm">Cara Bayar</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="cara_bayar" value="{{cara_bayar($patientTest['cara_bayar'])}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row mb-2">
                                    <label for="id_pengirim" class="col-5 col-form-label col-form-label-sm">Pengirim</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="id_pengirim" value="{{$patientTest['pengirim']['nama']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="id_penanggung_jawab" class="col-5 col-form-label col-form-label-sm">Penanggung Jawab</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="id_penanggung_jawab" value="{{$patientTest['penanggungJawab']['nama']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        {{-- For patient information --}}
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-row mb-2">
                                    <label for="no_pasien" class="col-5 col-form-label col-form-label-sm">No Pasien</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="no_pasien" value="{{$patientTest['patient']['noreg']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="nama_patient" class="col-5 col-form-label col-form-label-sm">Nama</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="nama_patient" value="{{$patientTest['patient']['nama']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="tempat_lahir" class="col-5 col-form-label col-form-label-sm">Tempat Lahir</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="tempat_lahir" value="{{$patientTest['patient']['tempat_lahir']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="tanggal_lahir" class="col-5 col-form-label col-form-label-sm">Tanggal Lahir</label>
                                    <div class="col-4">
                                        <input type="text" disabled class="form-control form-control-sm" id="tanggal_lahir" value="{{$patientTest['patient']['tanggal_lahir']}}">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" disabled class="form-control form-control-sm" id="umur" value="{{diff_years($patientTest['patient']['tanggal_lahir'])}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="jenis_kelamin" class="col-5 col-form-label col-form-label-sm">Jenis Kelamin</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="jenis_kelamin" value="{{$patientTest['patient']['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="no_telepon" class="col-5 col-form-label col-form-label-sm">No Telepon</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="no_telepon" value="{{$patientTest['patient']['no_telepon']}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="no_identitas" class="col-5 col-form-label col-form-label-sm">No KTP</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="no_identitas" value="{{$patientTest['patient']['no_identitas']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row mb-2">
                                    <label for="rt" class="col-5 col-form-label col-form-label-sm">RT/RW/KODEPOS</label>
                                    <div class="col-2">
                                        <input type="text" disabled class="form-control form-control-sm" id="rt" value="{{rt_rw_kodepos($patientTest['patient']['rt_rw_kodepos'],0)}}">
                                    </div>
                                    <div class="col-2">
                                        <input type="text" disabled class="form-control form-control-sm" id="rw" value="{{rt_rw_kodepos($patientTest['patient']['rt_rw_kodepos'],1)}}">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" disabled class="form-control form-control-sm" id="kodepos" value="{{rt_rw_kodepos($patientTest['patient']['rt_rw_kodepos'],2)}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="kd_provinsi" class="col-5 col-form-label col-form-label-sm">Provinsi</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="kd_provinsi" value="{{set_wilayah('provinsi',$patientTest['patient'])}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="kd_kota" class="col-5 col-form-label col-form-label-sm">kota</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="kd_kota" value="{{set_wilayah('kota',$patientTest['patient'])}}">
                                    </div>
                                </div><div class="form-row mb-2">
                                    <label for="kd_kecamatan" class="col-5 col-form-label col-form-label-sm">Kecamatan</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="kd_kecamatan" value="{{set_wilayah('kecamatan',$patientTest['patient'])}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="kd_keluraha " class="col-5 col-form-label col-form-label-sm">Kelurahan</label>
                                    <div class="col-7">
                                        <input type="text" disabled class="form-control form-control-sm" id="kd_keluraha " value="{{set_wilayah('kelurahan',$patientTest['patient'])}}">
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <label for="alamat" class="col-5 col-form-label col-form-label-sm">Alamat</label>
                                    <div class="col-7">
                                        <textarea disabled class="form-control form-control-sm" rows="3" id="alamat">{{$patientTest['patient']['alamat1']}}. {{$patientTest['patient']['alamat2']}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('patient_test_result.store') }}">
                    @csrf
                    @include('admin.patient_test._form_test_result')
                    <div class="form-group mt-3">
                        <button class="btn btn-success" type="submit">{{__('Tambahkan')}}</button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin') }}/js/patient_test.js"></script>
    <script>
        $.ajax({
            url: '',
            success: function(result){
                result.forEach(v=>{
                    let id_pendaftar=v.no_pendaftaran.toString();
                    id_pendaftar=id_pendaftar.substr(id_pendaftar.length-3,3);
                    let id_lab=v.id_hasil_lab.toString();
                })
                result.forEach((items)=>{
                    let id_pendaftar=items.no_pendaftaran.toString();
                    id_pendaftar=id_pendaftar.substr(id_pendaftar.length-3,3);
                    let id_lab=items.id_hasil_lab.toString();
                    let no_urut=id_pendaftar+id_lab;
                    for(i in items){
                        $('#'+i+'_'+no_urut).val(items[i]);
                    }
                    $('#is_duplo_'+no_urut).attr('checked',items.is_duplo==1);
                })
            }
        })
        $('.close').click(function(e){
            $(this).children()[0].classList.toggle('d-none');
            $(this).children()[1].classList.toggle('d-none');
        })
    </script>
@endpush
