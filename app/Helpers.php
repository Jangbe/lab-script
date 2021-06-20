<?php

use App\Models\HasilLabTiper;
use App\Models\PatientResultTest;
use App\Models\PatientTest;
use App\Models\Setting;
use Carbon\Carbon;
use Faker\Generator;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Http;

if(!function_exists('formated_price')){
    function formated_price($number){
        return "Rp. ".number_format($number,0,',','.');
    }
}

if(!function_exists('cara_bayar')){
    function cara_bayar($id)
    {
        switch($id){
            case 1:
                return 'TUNAI';
            case 2:
                return 'BPJS';
            default:
                return 'LAINYA';
        }
    }
}

if(!function_exists('diff_years')){
    function diff_years($date)
    {
        $date=Carbon::parse($date);
        $now=Carbon::now();
        return $date->diffInYears($now).' tahun';
    }
}

if(!function_exists('rt_rw_kodepos')){
    function rt_rw_kodepos($string,$index)
    {
        $data=explode('-',$string);
        return empty($data[$index])?($index==2?"000000":"000"):$data[$index];
    }
}

if(!function_exists('set_wilayah')){
    function set_wilayah($code,$data=[])
    {
        // var_dump($data['kd_provinsi']);die;
        switch($code){
            case 'provinsi':
                $response=Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();
                if(!is_null($response)){
                    foreach($response as $item){
                        if($item['id']==$data['kd_provinsi']){
                            return $item['name'];
                        }
                    }
                }return 'lain-lain';
            case 'kota':
                $response=Http::get("http://www.emsifa.com/api-wilayah-indonesia/api/regencies/$data[kd_provinsi].json")->json();
                if(!is_null($response)){
                    foreach($response as $item){
                        if($item['id']==$data['kd_kota']){
                            return $item['name'];
                        }
                    }
                }return 'lain-lain';
            case 'kecamatan':
                $response=Http::get("http://www.emsifa.com/api-wilayah-indonesia/api/districts/$data[kd_kota].json")->json();
                if(!is_null($response)){
                    foreach($response as $item){
                        if($item['id']==$data['kd_kecamatan']){
                            return $item['name'];
                        }
                    }
                }return 'lain-lain';
            case 'kelurahan':
                $response=Http::get("http://www.emsifa.com/api-wilayah-indonesia/api/villages/$data[kd_kecamatan].json")->json();
                if(!is_null($response)){
                    foreach($response as $item){
                        if($item['id']==$data['kd_kelurahan']){
                            return $item['name'];
                        }
                    }
                }return 'lain-lain';
            default:
                return 'Tidak Ditemukan';
        }
    }
}

if(!function_exists('nilai_normal')){
    function nilai_normal($patient,$nilaiNormal,$withDetail=true)
    {
        $age = explode(' ',diff_years($patient['patient']['tanggal_lahir']))[0];
        if($age<=1){
            return ($withDetail?'bayi ':'').($nilaiNormal['min_b']??0).' - '.($nilaiNormal['max_b']??0);
        }elseif($age<=16){
            return ($withDetail?'anak ':'').($nilaiNormal['min_a']??0).' - '.($nilaiNormal['max_a']??0);
        }elseif($patient['patient']['jenis_kelamin']=='L'){
            return ($withDetail?'pria ':'').($nilaiNormal['min_p']??0).' - '.($nilaiNormal['max_p']??0);
        }else{
            return ($withDetail?'wanita ':'').($nilaiNormal['min_w']??0).' - '.($nilaiNormal['max_w']??0);
        }
    }
}

if(!function_exists('tanggal')){
    function tanggal($tanggal)
    {
        $bulan=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $tanggal = date('d-m-Y', strtotime($tanggal));
        $tanggal = explode('-',$tanggal);
        return $tanggal[0].' '.$bulan[intval($tanggal[1])].' '.$tanggal[2];
    }
}

if(!function_exists('get_jam')){
    function get_jam($time)
    {
        $jam = explode(' ',$time)[1];
        $jam = explode(':', $jam);
        unset($jam[2]);
        return implode(':',$jam);
    }
}

if(!function_exists('penyebut')){
    function penyebut($nilai){
        $nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
        if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}
		return ucfirst($temp);
    }
}

if(!function_exists('generate_pdf')){
    function generate_pdf($patientRegistration,$type=1)
    {
        // type 1 => nota
        // type 2 => kwitansi
        // type 3 => test result
        // type 4 => laporan keuangan
        $patientRegistration['patientTest']=PatientTest::where('no_pendaftaran',strval($patientRegistration->no_pendaftaran))->get();
        if($type==1){
            $name='Nota - '.$patientRegistration['patient']['nama'];
            $pdf = PDF::loadView('pdf.nota',compact('patientRegistration'));
        }else if($type==2){
            $name='Kwitansi - '.$patientRegistration['patient']['nama'];
            $pdf = PDF::loadView('pdf.kwitansi',compact('patientRegistration'));
        }else if($type==3){
            $settings=['dpi' => 300,'fontHeightRatio'=>1,'defaultFont'=>'sans-serif'];
            $name='Hasil Lab - '.$patientRegistration['patient']['nama'];
            $patientRegistration['patientTestResult']=PatientResultTest::where('no_pendaftaran',strval($patientRegistration['no_pendaftaran']))->get();
            $show_header=setting('pdf','show_header')==1?3.9:0.0;
            $show_penanggung_jawab=setting('pdf','show_penanggung_jawab')==1?0.8:0.0;
            $margin_top=(3.2+$show_header+$show_penanggung_jawab).'cm';
            $pdf = PDF::setOptions($settings)->loadView('pdf.hasil_lab',compact('patientRegistration','margin_top'))->setPaper('a4', 'portrait')->setWarnings(false);
        }else{
            $pdf = PDF::loadView('pdf.laporan',compact('patientRegistration'));
        }
        return $pdf->stream($name.'.pdf');
    }
}

if(!function_exists('setting')){
    function setting($key, $index)
    {
        $setting = Setting::where('key',$key)->first();
        $value = collect(json_decode($setting->value))->toArray();
        return $value[$index];
    }
}
