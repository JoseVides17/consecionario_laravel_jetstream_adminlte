<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::with(['rol']);

        $name = $this->getInput($request, 'name');
        $email = $this->getInput($request, 'email');
        $fecha = $this->getInput($request, 'created_at');

        if ($name != null){
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email != null){
            $query->where('email', 'like', '%' . $email . '%');
        }

        if ($fecha != null) {
            $query->where('created_at', 'like', '%' . $fecha . '%');
        }

        $users = $query->orderBy('rol_id')->paginate(5)->withQueryString();

        return view('user.index', compact('users', 'name', 'email', 'fecha'));
    }

    public function create()
    {
        $roles = Role::all();
        $new = true;
        return view('user.create', compact('new', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {
        $data = $request->validated();
        $user = new User();
        $user->fill($data);
        $user->password = bcrypt($data['password']);
        $user->rol_id = $data['rol_id'];
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('rol')->findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('rol')->findOrFail($id);
        $roles = Role::all();
        $new = false;

        return view('user.editar', compact('user', 'roles', 'new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate($this->validar());
        $user = User::findOrFail($id);
        $user->update($data);
        $user->rol_id = $data['rol_id'];
        $user->save();
        session()->flash('success', 'Usuario actualizado correctamente.');
        return redirect()->route('users.index')->with('success', 'Actualizado Correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user != null){
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente!');
        }
        else
            return redirect()->route('users.index')->with('error', 'No tienes permiso para eliminar este usuario!.');
    }

    protected function getInput(Request $request, $key, $default = null)
    {
        return $request->input($key, $default);
    }

    protected function validar(){
        return [
            'name' => 'required',
            'email' => 'required',
            'rol_id' => 'required',
        ];
    }
}
