<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabSample extends Model
{
    use HasFactory;
    protected $table = 'item_lab_samples';

    public function item()
    {
        return $this->hasMany(Item::class, 'id_group', 'id');
    }
}
