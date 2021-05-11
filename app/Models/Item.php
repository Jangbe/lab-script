<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group', 'id');
    }

    public function clasification()
    {
        return $this->belongsTo(Clasification::class, 'id_klasifikasi', 'id');
    }

    public function labGroup()
    {
        return $this->belongsTo(LabGroup::class, 'id_lab_group', 'id');
    }

    public function labSample()
    {
        return $this->belongsTo(LabSample::class, 'id_lab_sample', 'id');
    }

    public function hasilLab()
    {
        return $this->hasMany(HasilLab::class, 'id_item', 'id');
    }

    public function itemTarif()
    {
        return $this->hasOne(itemTarif::class, 'id_item', 'id');
    }

    public function patientTest()
    {
        return $this->hasMany(PatientTest::class, 'id_item','id');
    }
}
