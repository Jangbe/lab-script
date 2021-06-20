<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    private $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $laporan=$this->laporan;
        return view('exports.laporan',compact('laporan'));
    }
}
