<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveClienteRequest;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cliente::query('select * from clientes');

        $nombre = $this->getInput($request, 'nombre');
        $email = $this->getInput($request, 'email');
        $dni = $this->getInput($request, 'dni');

        if ($nombre != null) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }
        if ($email != null) {
            $query->where('email', 'like', '%' . $email . '%');
        }
        if ($dni != null) {
            $query->where('dni', 'like', '%' . $dni . '%');
        }
        $clientes = $query->orderBy('id')->paginate(15);

        return view('clientes.index', compact('clientes', 'nombre', 'email', 'dni'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveClienteRequest $request)
    {
        $data = $request->validated();
        $cliente = new Cliente();
        $cliente->fill($data);
        $cliente->save();
        return redirect()->route('clientes.index')->with('cliente_reg', 'El registro se guardo correctamente.');
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate($this->validar());
        $user = Cliente::findOrFail($id);
        $user->update($data);
        return redirect()->route('clientes.index')->with('cliente_update', 'El registro se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Cliente::findOrFail($id);
        $user->delete();
        return redirect()->route('clientes.index');
    }
    protected function getInput(Request $request, $key, $default = null)
    {
        return $request->input($key, $default);
    }

    protected function validar(){
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ];
    }
}
