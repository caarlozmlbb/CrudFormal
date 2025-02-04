<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function listar_usuarios(){
        $usuarios = User::all();

        return view('usuarios.lista',[
            'usuarios' => $usuarios
        ]);
    }

    public function crear_usuario(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success','Creado con exito');
    }

    public function eliminar_usuario($id){
        $usuario = User::find($id);
        $usuario->delete();
        return redirect()->back()->with('success', 'Eliminado con exito');
    }
}
