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
                        <td class="pl-2 text-center">{{$hasilLab['nilaiNormal']['satuan']}}</td>
                        <td class="pl-2 text-center">{{nilai_normal($patientRegistration,$hasilLab['nilaiNormal'],false)}}</td>
                        <td class="pl-2"></td>
                    </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
@endsection

@push('js')
    <script>
        // $.ajax({
        //     url: '{{url("admin/patient_test/").$patientRegistration["no_pendaftaran"]}}',
        //     success: function(result){
        //         console.log(result);
        //         result.forEach(v=>{
        //             let id_pendaftar=v.no_pendaftaran.toString();
        //             id_pendaftar=id_pendaftar.substr(id_pendaftar.length-3,3);
        //             let id_lab=v.id_hasil_lab.toString();
        //         })
        //         result.forEach((items)=>{
        //             let id_pendaftar=items.no_pendaftaran.toString();
        //             id_pendaftar=id_pendaftar.substr(id_pendaftar.length-3,3);
        //             let id_lab=items.id_hasil_lab.toString();
        //             let no_urut=id_pendaftar+id_lab;
        //             console.log(no_urut+' => '+items.hasil_teks);
        //             for(i in items){
        //                 $('#'+i+'_'+no_urut).val(items[i]);
        //             }
        //             $('#is_duplo_'+no_urut).attr('checked',items.is_duplo==1);
        //         })
        //     }
        // })
    </script>
@endpush
