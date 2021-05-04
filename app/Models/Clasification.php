<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasification extends Model
{
    use HasFactory;
    protected $table = 'item_clasifications';

    public function item()
    {
        return $this->hasMany(Item::class, 'id_group', 'id');
    }
}
