<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{    
    public function index()
    {
        $usuarios = User::All();
        return view('usuario.index', ['model' => $usuarios]);
    }
   
    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make('10203040');
        $usuario->save();
        
        return redirect()->route('usuarios')->withStatus(__('Cadastro Realizado com Sucesso!'));
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (isset($user)) {
            $user->delete();
        }
        return redirect()->route('usuarios')->withStatus(__('Cadastro Excluído com Sucesso!'));;        
    }
}
