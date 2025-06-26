<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $clientesActivos = Cliente::where('estado', 'Activo')->count();

        return view('clientes.index', compact('clientes', 'clientesActivos'));
    }

    // Guardar un nuevo cliente desde el modal
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    // Ver detalles de un cliente
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar un cliente (solo si es admin)
    public function destroy($id)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permisos para eliminar clientes.');
        }

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}


