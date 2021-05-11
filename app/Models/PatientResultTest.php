<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientResultTest extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $table = 'patient_test_results';

    public function getRouteKeyName()
    {
        return 'no_pendaftaran';
    }

    public function patientRegistration()
    {
        return $this->belongsTo(PatienRegistration::class, 'no_pendaftaran','no_pendaftaran');
    }

    public function hasilLab()
    {
        return $this->belongsTo(HasilLab::class, 'id_hasil_lab','id');
    }

    public function hasilLabTiper()
    {
        return $this->belongsTo(HasilLabTiper::class, 'id_tiper','id');
    }
}
