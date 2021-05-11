<?php

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
    function nilai_normal($patient,$nilaiNormal)
    {
        $age = explode(' ',diff_years($patient['patient']['tanggal_lahir']))[0];
        if($age<=1){
            return 'bayi '.$nilaiNormal['min_b'].' - '.$nilaiNormal['max_b'];
        }elseif($age<=5){
            return 'anak '.$nilaiNormal['min_a'].' - '.$nilaiNormal['max_a'];
        }elseif($patient['patient']['jenis_kelamin']=='L'){
            return 'pria '.$nilaiNormal['min_p'].' - '.$nilaiNormal['max_p'];
        }else{
            return 'wanita '.$nilaiNormal['min_w'].' - '.$nilaiNormal['max_w'];
        }
    }
}
