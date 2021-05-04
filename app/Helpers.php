<?php

if(!function_exists('formated_price')){
    function formated_price($number){
        return "Rp. ".number_format($number,0,',','.');
    }
}
