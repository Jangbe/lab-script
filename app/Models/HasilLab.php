<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLab extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id');
    }

    public function hasilLabTiper()
    {
        return $this->belongsTo(HasilLabTiper::class, 'id_tiper', 'id');
    }

    public function nilaiNormal()
    {
        return $this->hasOne(NilaiNormal::class, 'id_hasil_lab', 'id');
    }
}
