<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabGroup extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->hasMany(Item::class, 'id_group', 'id');
    }
}
