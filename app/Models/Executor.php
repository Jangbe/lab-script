<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executor extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function patientTest()
    {
        return $this->hasMany(PatientTest::class, 'id_pelaksana','id');
    }

    public function patientRegistration()
    {
        return $this->belongsTo(PatientRegistration::class, 'id_penanggung_jawab','id');
    }
}
