<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatLabRinci extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function alatLab()
    {
        return $this->belongsTo(AlatLab::class, 'id_alat','id');
    }
}
