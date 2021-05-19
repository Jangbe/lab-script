@extends('layouts.pdf',['title'=>'Hasil Lab'])
@section('style')
<style media="screen">
    table {page-break-before:auto;}
    @page {
        margin: 0cm 0cm;
    }

    /** Define now the real margins of every page in the PDF **/
    /*
        ukuran:
        -> normal                  = 4.2cm
        -> dengan penanggung jawab = +0.8cm
        -> dengan gambar header    = +3.1cm
     */
    body {
        margin-top: {{$margin_top}};
        margin-left: 1cm;
        margin-right: 1cm;
        margin-bottom: 1cm;
    }

    /** Define the header rules **/
    #header {
        position: fixed;
        top: 1cm;
        left: 0cm;
        right: 0cm;
        height: 5cm;
        margin-left: 1cm;
        margin-right: 1cm;
    }
    table.table-bordered{
        border:1px solid black;
        margin-top:20px;
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
    }
    .table-bordered tbody tr:nth-child(even) {
       background-color: #f2f2f2e8;
    }
    .page-break{
        page-break-after: always
    }
</style>
@endsection
@section('content')
<div id="header">
    @if (setting('pdf','show_header')==1)
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/header.png'))) }}"
        alt="" srcset=""
        style="width: 100%">
    <hr class="mt-0 mb-4 border-dark">
    @endif
    @if (setting('pdf','show_penanggung_jawab'))
        <span class="float-right">Penanggung Jawab : dr. Puskesmas</span>
        <div class="clearfix"></div>
    @endif
    <h3 class="text-center" style="font-family: sans-serif">HASIL PEMERIKSAAN LABORATORIUM</h3>
    <table style="width: 100%">
        <tr>
            <th style="width: 17%">No. Lab</th>
            <td style="width: 30px">:</td>
            <td style="width: 33%">{{substr($patientRegistration['no_pendaftaran'],-10,10)}}</td>
            <th style="width: 37%">No. Rek. Med</th>
            <td style="width: 30px">:</td>
            <td>{{$patientRegistration['no_rm']}}</td>
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
            <td>{{get_jam($patientRegistration['created_at'])}}</td>
        </tr>
    </table>
</div>

@foreach ($patientRegistration['patientTest'] as $test)
    <table style="width: 100%" class="table-bordered table-striped border-dark">
        <thead class="text-center text-dark" style="background: #84e2ff">
            <tr>
                <th style="height: 120px;vertical-align: middle">JENIS PEMERIKSAAN</th>
                <th style="height: 120px;vertical-align: middle">HASIL</th>
                <th style="height: 120px;vertical-align: middle">SATUAN</th>
                <th style="height: 120px;vertical-align: middle">NILAI NORMAL</th>
                <th style="height: 120px;vertical-align: middle">KETERANGAN</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            @if ($test['item']['hasilLab']->isNotEmpty())
                <tr>
                    <td colspan="5" class="text-center font-weight-bold" style="background: #c0bfbf">{{$test['item']['labGroup']['lab_group_name']}}</td>
                </tr>
                @foreach ($test['item']['hasilLab']->sortBy('no_urut') as $no => $hasilLab)
                    {{-- Jika jenis hasil lab nya judul --}}
                    @if ($hasilLab->is_judul==1)
                    <tr>
                        <td class="pl-2" colspan="5">{{$hasilLab['nm_hasil']}}</td>
                    </tr>
                    {{-- Jika jenis hasil lab nya berupa select options --}}
                    @elseif (!is_null($hasilLab['id_tiper']))
                    <tr>
                        <td class="pl-{{$hasilLab['level_hasil']=='1'?2:4}}">{{$hasilLab['nm_hasil']}}</td>
                        <td class="pl-2 text-center">{{collect($patientRegistration['patientTestResult'])->where('id_hasil_lab',$hasilLab['id'])->first()['hasilLabTiper']['nm_tiper']}}</td>
                        <td class="pl-2 text-center"></td>
                        <td class="pl-2 text-center">{{$hasilLab['hasilLabTiper']['nm_tiper']}}</td>
                        <td class="pl-2"></td>
                    </tr>
                    {{-- Jika jenis hasil lab nya teks --}}
                    @elseif($hasilLab->is_teks==1)
                    <tr>
                        <td class="pl-{{$hasilLab['level_hasil']=='1'?2:4}}">{{$hasilLab['nm_hasil']}}</td>
                        <td class="pl-2 text-center">{{collect($patientRegistration['patientTestResult'])->where('id_hasil_lab',$hasilLab['id'])->first()['hasil_teks']??''}}</td>
                        <td class="pl-2 text-center"></td>
                        <td class="pl-2 text-center"></td>
                        <td class="pl-2"></td>
                    </tr>
                    {{-- Jika jenis hasil lab nya angka dan mempunyai nilai normal --}}
                    @elseif($hasilLab->is_nilai_normal==1)
                    <tr>
                        <td class="pl-{{$hasilLab['level_hasil']=='1'?2:4}}">{{$hasilLab['nm_hasil']}}</td>
                        <td class="pl-2 text-center">{{collect($patientRegistration['patientTestResult'])->where('id_hasil_lab',$hasilLab['id'])->first()['nilai']??0}}</td>
                        <td class="pl-2 text-center">{{$hasilLab['nilaiNormal']['satuan']??'-'}}</td>
                        <td class="pl-2 text-center">{{nilai_normal($patientRegistration,$hasilLab['nilaiNormal'],false)}}</td>
                        <td class="pl-2"></td>
                    </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
    @if (!$loop->last)
        <div class="page-break"></div>
    @else
        <table style="width: 100%">
            <tr>
                <td style="width: 60%"></td>
                <td class="text-center text-dark mt-3">
                    <span>Pemeriksa</span><br><br><br>
                    <span>{{$test['executors']['nama']??''}}</span>
                </td>
            </tr>
        </table>
    @endif
@endforeach
@endsection
