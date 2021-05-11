<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $primaryKey=null;
    public $incrementing=false;

    public function getRouteKeyName()
    {
        return 'no_pendaftaran';
    }

    public function patientRegistration()
    {
        return $this->belongsTo(PatientRegistration::class, 'no_pendaftaran','no_pendaftaran');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item','id');
    }

    public function executors()
    {
        return $this->belongsTo(Executor::class, 'id_pelaksana','id');
    }
}
