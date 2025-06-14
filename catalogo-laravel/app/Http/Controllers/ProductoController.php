<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producto::with('categorias')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'descripcion' => 'nullable|string',
        //     'precio' => 'required|numeric|min:0',
        //     // Agrega aquí otras reglas según los campos de tu modelo Producto
        // ]);
        // Producto::create($validated);
        // return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|string|',
            'stock' => 'required|integer|min:0',
            'categorias' => 'nullable|array', //IDs categorias 
            'categorias.*' => 'exists:categorias,id', // Validar que los IDs de categorias existan
        ]);
        $producto = DB::transaction(function () use ($validated, $request) {
            $producto = Producto::create($validated);
            if ($request->has('categorias')) {
                $producto->categorias()->sync($request->categorias);
            }
            return $producto;
        });

        return response()->json([
            'message' => 'Producto creado exitosamente.',
            'producto' => $producto,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::with('categorias')->findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'precio' => 'sometimes|required|numeric|min:0',
            'imagen' => 'nullable|string|',
            'stock' => 'sometimes|required|integer|min:0',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categorias,id',
        ]);
        $producto->update($validated);
        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }
        $producto = Producto::with('categorias')->find($producto->id);

        return response()->json([
            'message' => 'Producto actualizado exitosamente.',
            'producto' => $producto,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado exitosamente.'], 200);

    }
}
