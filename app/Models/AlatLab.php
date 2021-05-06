<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatLab extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function alatLabRinci()
    {
        return $this->hasMany(AlatLabRinci::class, 'id_alat', 'id');
    }
}
