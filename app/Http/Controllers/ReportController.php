<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', '300'); 
use App\Models\PatientRegistration;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function nota(PatientRegistration $patientRegistration)
    {
        return generate_pdf($patientRegistration);
    }

    public function kwitansi(PatientRegistration $patientRegistration)
    {
        return generate_pdf($patientRegistration,2);
    }

    public function hasil_lab(PatientRegistration $patientRegistration)
    {
        return generate_pdf($patientRegistration,3);
    }
}
