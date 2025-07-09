<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Product extends Model
{
    use HasFactory;

    // Tabla asociada (opcional si el nombre sigue la convención)
    protected $table = 'productos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'user',            // id del usuario que subió el producto
        'title',
        'description',
        'estado',
        'categoria_id',
        'transaction_type',
        'location',
        'image',
    ];

    /**
     * Relación con el usuario que subió el producto.
     */
    public function usuario()
    {
        // Aquí 'user' es la columna en productos que referencia a users.id
        return $this->belongsTo(User::class, 'user');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
