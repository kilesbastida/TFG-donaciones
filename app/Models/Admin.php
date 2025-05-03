<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Si utilizas una tabla personalizada para los administradores
    protected $table = 'admins'; // Aquí defines la tabla que se usará, en caso que no sea 'admins', ajusta según tu tabla en la base de datos

    // Definir los atributos que se pueden llenar
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Asegurarnos de que la contraseña esté oculta
    protected $hidden = [
        'password',
    ];

    // Si necesitas convertir las fechas en formato carbon (opcional)
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
