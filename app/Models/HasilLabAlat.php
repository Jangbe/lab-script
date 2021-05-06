<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLabAlat extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];

    public function hasilLab()
    {
        return $this->belongsTo(HasilLab::class, 'id_hasil_lab','id');
    }

    public function alatLabRinci()
    {
        return $this->belongsTo(AlatLabRinci::class, 'id_alat_lab_rinci','id');
    }
}
