@extends('layouts.pdf',['title'=>'Nota'])

@section('content')
    <h3 class="text-center mt-3">NOTA PEMERIKSAAN LABORATORIUM</h3>
    <table style="width: 100%">
        <tr>
            <th style="width: 22%">Nama</th>
            <td style="width: 10px">:</td>
            <td>{{$patientRegistration['patient']['nama']}}</td>
            <th style="width: 22%">No. Lab</th>
            <td style="width: 10px">:</td>
            <td>{{substr($patientRegistration['no_pendaftaran'],-10,10)}}</td>
        </tr>
        <tr>
            <th>Umur</th>
            <td>:</td>
            <td>{{diff_years($patientRegistration['patient']['tanggal_lahir'])}}</td>
            <th>No. Rek. Med</th>
            <td>:</td>
            <td>{{$patientRegistration['patient']['noreg']}}</td>
        </tr>
        <tr>
            <th>Kelamin</th>
            <td>:</td>
            <td>{{$patientRegistration['patient']['jenis_kelamin']=='L'?'Laki-laki':'Perempuan'}}</td>
            <th>Tgl. Periksa</th>
            <td>:</td>
            <td>{{tanggal($patientRegistration['created_at'])}}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>:</td>
            <td rowspan="4" style="vertical-align: top;">{{$patientRegistration['patient']['alamat1'].' '.$patientRegistration['patient']['alamat2']}}</td>
            <th>Dokter</th>
            <td>:</td>
            <td>{{$patientRegistration['pengirim']['nama']}}</td>
        </tr>
    </table>

    <table class="table-bordered" style="width: 100%">
        <thead>
            <tr class="text-center">
                <th style="width: 5%">NO</th>
                <th style="width: 40%">KETERANGAN</th>
                <th style="width: 18%">BIAYA</th>
                <th style="width: 37%">PERINCIAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center" style="vertical-align: top;">
                @foreach ($patientRegistration['patientTest'] as $test)
                        {{$loop->iteration}} <br>
                @endforeach
                </td>
                <td class="pl-2" style="vertical-align: top;">
                @foreach ($patientRegistration['patientTest'] as $test)
                    {{$test['item']['nm_item']}} <br>
                @endforeach
                </td>
                <td class="pl-2" style="vertical-align: top;">
                @foreach ($patientRegistration['patientTest'] as $test)
                    {{formated_price($test['harga'])}} <br>
                @endforeach
                </td>
                <td class="px-2" style="vertical-align: top;">
                    <table class="table-borderless mb-4" style="width: 100%">
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>{{formated_price($patientRegistration['subtotal']+($patientRegistration['nilai_cito']??0))}}</td>
                        </tr>
                        <tr>
                            <td>Biaya Adm</td>
                            <td>:</td>
                            <td>{{formated_price($patientRegistration['nilai_admin']??0)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><hr class="my-2"></td>
                        </tr>
                        <tr>
                            <td>Total Biaya</td>
                            <td>:</td>
                            <td>{{formated_price($patientRegistration['subtotal']+($patientRegistration['nilai_cito']??0)+($patientRegistration['nilai_admin']??0))}}</td>
                        </tr>
                        <tr>
                            <td>Uang Muka</td>
                            <td>:</td>
                            <td>{{formated_price($patientRegistration['nilai_uangmuka']??0)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><hr class="my-2"></td>
                        </tr>
                        <tr>
                            <td>Sisa</td>
                            <td>:</td>
                            <td>{{formated_price($patientRegistration['subtotal']+($patientRegistration['nilai_cito']??0)+($patientRegistration['nilai_admin']??0)-($patientRegistration['nilai_uangmuka']??0))}}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>:</td>
                            <td>{{cara_bayar($patientRegistration['cara_bayar'])}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
