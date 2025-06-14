<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'producto_id',
        'solicitante_id',
        'tipo',
        'estado',
    ];

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }
}
