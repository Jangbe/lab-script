@extends('layouts.pdf',['title'=>'Kwitansi'])

@section('content')
<style>
    table tr td{
        vertical-align: top;
    }
</style>
<table style="width: 100%">
    <tr>
        <td>
            <h3 class="mb--2">{{setting('identitas','uraian')}}</h3>
            <h1 class="my--1">{{setting('identitas','nama')}}</h1>
            <small class="text-sm">{{setting('identitas','alamat')}}</small><br>
            <small class="text-sm">E-Mail: {{setting('identitas','email')}}</small><br>
            <small class="text-sm">No. Telp. {{setting('identitas','no_telp')}} No Fax. {{setting('identitas','no_fax')}}</small>
        </td>
        <td style="vertical-align: top">
            <h1>K U I T A N S I</h1>
            <h3 class="font-weight-normal">NOMOR LAB : {{substr($patientRegistration['no_pendaftaran'],-10,10)}}</h3>
        </td>
    </tr>
</table>

<table class="mt-3 ml-2 text-dark m-2" style="width: 100%">
    <tr>
        <td style="width: 35%">Terima Dari</td>
        <td style="width: 2%">:</td>
        <td>{{$patientRegistration['pembayar']}}</td>
    </tr>
    <tr>
        <td>Uang Sejumlah</td>
        <td>:</td>
        <td>{{Str::title(penyebut($patientRegistration['nilai_uangmuka']??0))}} Rupiah</td>
    </tr>
    <tr>
        <td >Untuk Pembayaran </td>
        <td> : </td>
        <td style="height: 60px">
            @foreach ($patientRegistration['patientTest'] as $test)
                @if ($loop->first)
                    {{$test['item']['nm_item'].', '}}
                @else
                    {{$test['item']['nm_item']}}
                @endif
            @endforeach
        </td>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td>:</td>
        <td>{{$patientRegistration['patient']['nama']}}</td>
    </tr>
    <tr>
        <td class="mb-2">Dokter</td>
        <td>:</td>
        <td>{{$patientRegistration['pengirim']['nama']}}</td>
    </tr>
    <tr>
        <td colspan="3" style="height: 20px; vertical-align: middle;" class="text-center">
            <span style="border: 1px solid black; display: block; width: 60%; height: 25px;" class="font-weight-bold my-2">{{formated_price($patientRegistration['nilai_uangmuka'])}}</span>
        </td>
    </tr>
</table>
@endsection
