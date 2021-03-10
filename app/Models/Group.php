<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function item()
    {
        return $this->hasMany(Item::class, 'id_group', 'id');
    }

}
