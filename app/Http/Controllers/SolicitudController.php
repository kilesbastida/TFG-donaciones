<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:donacion,intercambio',
        ]);

        $producto = Product::findOrFail($request->producto_id);

        $existe = Solicitud::where('producto_id', $producto->id)
            ->where('solicitante_id', Auth::id())
            ->where('estado', 'pendiente')
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya has enviado una solicitud pendiente para este producto.');
        }

        Solicitud::create([
            'producto_id' => $producto->id,
            'solicitante_id' => Auth::id(),
            'tipo' => $request->tipo,
        ]);

        return back()->with('success', 'Solicitud enviada correctamente.');
    }

    public function index()
    {
        $usuarioId = Auth::id();

        // Solicitudes que otros usuarios hicieron a productos míos
        $recibidas = Solicitud::whereHas('producto', function ($query) use ($usuarioId) {
            $query->where('user', $usuarioId);
        })
        ->with(['producto', 'producto.usuario', 'solicitante'])
        ->latest()->get();

        // Solicitudes que yo envié a productos de otros usuarios
        $enviadas = Solicitud::where('solicitante_id', $usuarioId)
            ->with(['producto', 'producto.usuario'])
            ->latest()->get();

        return view('solicitudes.index', compact('recibidas', 'enviadas'));
    }

    public function responder(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $producto = $solicitud->producto;

        if ($producto->user !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'accion' => 'required|in:aceptar,rechazar,entregar',
        ]);

        if ($request->accion === 'aceptar') {
            $solicitud->estado = 'aceptada';

            // Rechazar otras solicitudes pendientes del mismo producto
            Solicitud::where('producto_id', $producto->id)
                ->where('id', '!=', $solicitud->id)
                ->where('estado', 'pendiente')
                ->update(['estado' => 'rechazada']);
        } elseif ($request->accion === 'entregar') {
            if ($solicitud->estado !== 'aceptada') {
                return back()->with('error', 'Solo se puede marcar como entregado una solicitud aceptada.');
            }

            $solicitud->estado = 'entregado';
            $producto->comprado = true;
            $producto->save();
        } else {
            $solicitud->estado = 'rechazada';
        }

        $solicitud->save();

        return back()->with('success', 'Solicitud ' . $request->accion . ' correctamente.');
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Solo puede eliminar si es el solicitante o dueño del producto
        $usuarioId = Auth::id();
        $esSolicitante = $solicitud->solicitante_id === $usuarioId;
        $esDuenoProducto = $solicitud->producto->user === $usuarioId;

        if (!($esSolicitante || $esDuenoProducto)) {
            abort(403);
        }

        // Solo se permite eliminar si está entregada o rechazada
        if (!in_array($solicitud->estado, ['entregado', 'rechazada'])) {
            return back()->with('error', 'Solo puedes eliminar solicitudes entregadas o rechazadas.');
        }

        $solicitud->delete();

        return back()->with('success', 'Solicitud eliminada del historial.');
    }
}
