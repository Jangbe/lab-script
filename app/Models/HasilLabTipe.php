<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLabTipe extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function hasilLabTiper()
    {
        return $this->hasMany(HasilLabTiper::class, 'id_tipe', 'id');
    }
}
