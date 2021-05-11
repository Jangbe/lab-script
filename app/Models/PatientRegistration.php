<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRegistration extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $primaryKey='no_pendaftaran';

    public function getRouteKeyName()
    {
        return 'no_pendaftaran';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'no_rm','noreg');
    }

    public function patientTest()
    {
        return $this->hasMany(PatientTest::class, 'no_pendaftaran','no_pendaftaran');
    }

    public function patientTestResult()
    {
        return $this->hasMany(patientTestResult::class, 'no_pendaftaran','no_pendaftaran');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(Executor::class, 'id_penanggung_jawab','id');
    }

    public function pengirim()
    {
        return $this->belongsTo(Executor::class, 'id_pengirim', 'id');
    }
}
