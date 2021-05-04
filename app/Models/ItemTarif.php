<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTarif extends Model
{
    use HasFactory;
    protected $guarded=['id_item','created_at','updated_at'];
    protected $primaryKey='id_item';

    public function getRouteKeyName(){
        return 'id_item';
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'id_item');
    }
}
