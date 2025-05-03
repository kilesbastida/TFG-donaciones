<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu()
    {
        // Lógica del menu de administración
        return view('admin.menu'); // Asegúrate de tener esta vista creada
    }
}
