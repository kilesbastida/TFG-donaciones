<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'denunciante_id',
        'denunciado_id',
        'razon',
        'descripcion',
        'estado',
        'resolucion',
    ];

    // Relaciones

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function denunciante()
    {
        return $this->belongsTo(User::class, 'denunciante_id');
    }

    public function denunciado()
    {
        return $this->belongsTo(User::class, 'denunciado_id');
    }
}
