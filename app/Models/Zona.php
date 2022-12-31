<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
   protected $fillable=[
       'nombre','created_user','created_at'
   ];

   public function user()
   {
       return $this->belongsTo(User::class,'created_user','id');
   }
}
