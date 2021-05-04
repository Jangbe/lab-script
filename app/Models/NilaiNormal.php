<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiNormal extends Model
{
    use HasFactory;
    protected $table = 'nilai_normal';
    protected $guarded = ['id','created_at','updated_at'];

    public function hasilLab()
    {
        return $this->hasOne(HasilLab::class, 'id_hasil_lab', 'id');
    }
}
