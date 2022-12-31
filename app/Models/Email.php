<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'enviador_id',
        'zona_id',
        'nombre_archivo',
        'asunto',
        'cuerpo',
        'created_at',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class,'zona_id','id');
    }
}
