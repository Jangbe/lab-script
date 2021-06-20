@extends('layouts.pdf',['title'=>'Laporan'])

@section('content')
<style>
    table tr td{
        vertical-align: top;
        padding: 5px;
    }
    table tr th{
        text-align: center;
    }
    .table-bordered thead tr th{
        border: 1px solid black;
    }
    .table-bordered tbody tr td{
        border: 1px solid black;
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
    </tr>
</table>

<center>
    <h2 style="padding: 0;margin: 0;margin-top: 10px;color: black">DAFTAR PEMERIKSAAN LABORATORIUM</h2>
    <h2 style="padding: 0;margin: 0;margin-bottom: 10px;color: black">Tanggal : {{$request->from}} sampai dengan {{$request->to}}</h2>
</center>

<table class="mt-3 ml-2 text-dark m-2 table-bordered" style="width: 100%;border-color: black">
    <thead>
        <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>NAMA</th>
            <th>TOTAL BIAYA</th>
            <th>DOKTER PENGIRIM</th>
            <th>FEE</th>
        </tr>
    </thead>
    <tbody id="result">
        @foreach ($results as $result)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$result['tanggal']}}</td>
                <td>{{$result['nama']}}</td>
                <td>{{formated_price($result['total_biaya'])}}</td>
                <td>{{$result['nama_dokter']}}</td>
                <td>{{formated_price($result['fee'])}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
