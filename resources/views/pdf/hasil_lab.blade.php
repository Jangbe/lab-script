@extends('layouts.pdf',['title'=>'Hasil Lab'])

@section('content')
<span class="float-right mt-6">Penanggung Jawab : {{$patientRegistration['penanggungJawab']['nama']}}</span>
<div class="clearfix"></div>
<h3 class="text-center mt-3">HASIL PEMERIKSAAN LABORATORIUM</h3>
<table style="width: 100%">
    <tr>
        <th style="width: 17%">No. Lab</th>
        <td style="width: 30px">:</td>
        <td style="width: 33%">{{substr($patientRegistration['no_pendaftaran'],-10,10)}}</td>
        <th style="width: 37%">No. Rek. Med</th>
        <td style="width: 30px">:</td>
        <td>{{$patientRegistration['no_pendaftaran']}}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>:</td>
        <td>{{$patientRegistration['patient']['nama']}}</td>
        <th>Doktor Pengirim</th>
        <td>:</td>
        <td>{{$patientRegistration['pengirim']['nama']}}</td>
    </tr>
    <tr>
        <th>Umur / Kel.</th>
        <td>:</td>
        <td>{{diff_years($patientRegistration['patient']['tanggal_lahir'])}} / {{$patientRegistration['patient']['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</td>
        <th>Tanggal Pemeriksaan</th>
        <td>:</td>
        <td>{{tanggal($patientRegistration['created_at'])}}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>:</td>
        <td rowspan="4" style="vertical-align: top;">{{$patientRegistration['patient']['alamat1'].' '.$patientRegistration['patient']['alamat2']}}</td>
        <th>Jam Pemeriksaan</th>
        <td>:</td>
        <td>{{explode(' ',$patientRegistration['created_at'])[1]}}</td>
    </tr>
</table>
<table style="width: 100%" class="table-bordered">
    <thead class="text-center bg-pink text-dark">
        <tr>
            <th style="height: 120px;vertical-align: middle">JENIS PEMERIKSAAN</th>
            <th style="height: 120px;vertical-align: middle">HASIL</th>
            <th style="height: 120px;vertical-align: middle">SATUAN</th>
            <th style="height: 120px;vertical-align: middle">NILAI NORMAL</th>
            <th style="height: 120px;vertical-align: middle">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patientRegistration['patientTest'] as $test)
            @if ($test['item']['hasilLab']->isNotEmpty())
                <tr>
                    <td colspan="5" class="text-center font-weight-bold">{{$test['item']['labGroup']['lab_group_name']}}</td>
                </tr>
                @foreach ($patientRegistration['patientTestResult'] as $testResult)
                    <tr>
                        <td class="pl-{{$testResult['hasilLab']['level_hasil']=='1'?2:4}}">{{$testResult['hasilLab']['nm_hasil']}}</td>
                        <td class="pl-2 text-center">{{hasil_test($testResult)}}</td>
                        <td class="pl-2 text-center">{{$testResult['hasilLab']['nilaiNormal']['satuan']}}</td>
                        <td class="pl-2 text-center">{{hasil_test_normal($patientRegistration,$testResult)}}</td>
                        <td class="pl-2">{{$testResult['keterangan']}}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
@endsection
