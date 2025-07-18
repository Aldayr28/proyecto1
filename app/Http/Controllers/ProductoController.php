<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        //cada producto vendra con su usuario relacionado
        //return Producto::with('user')->get();
        $productos = \App\Models\Producto::with('user')->get();

        return Inertia::render('productos', [
        'productos' => $productos
    ]);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        //cada producto vendra con su usuario relacionado
        return Producto::with('user')->findOrFail($id);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(null, 204);
    }
}
