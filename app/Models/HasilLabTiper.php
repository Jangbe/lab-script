<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLabTiper extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function hasilLab()
    {
        return $this->hasMany(HasilLab::class, 'id_tiper', 'id');
    }

    public function hasilLabTipe()
    {
        return $this->belongsTo(HasilLabTipe::class, 'id_tipe', 'id');
    }
}
