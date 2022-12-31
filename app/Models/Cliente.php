<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $fillable=[
       'nombre','email','codpostal','zona_id','created_user','created_at'
   ];

    public function zona()
    {
        return $this->belongsTo(Zona::class,'zona_id','id');
    }
}
