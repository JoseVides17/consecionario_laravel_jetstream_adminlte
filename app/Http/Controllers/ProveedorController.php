<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveClienteRequest;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveClienteRequest $request)
    {
        $data = $request->validated();
        $proveedor = new Proveedor();
        $proveedor->fill($data);
        $proveedor->save();
        return session('prov_reg', 'Registro guardado correctamente');
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = User::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);
        $user->update($data);
        return session('prov_act', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return session('prov_del', 'Registro eliminado correctamente');
    }
}
