<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserStatus;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $status = UserStatus::all();
        
        $usuarios = User::all();            
        return View('usuarios', compact('usuarios', 'status'));
      
    }

    function edit($id)
    {
        $usuario = User::find($id);
        $status = UserStatus::all();
        return View('usuarios-edit', compact('usuario', 'status'));
    }

    function create(Request $request)
    {
        $request->validate([        
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if(User::create(['name' => $request['name'], 'email' => $request['email'], 'password' => Hash::make($request['password'])]))
        {
            return redirect('/usuario');
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([        
            'name' => ['required', 'string', 'max:255'],            
            'password' => ['confirmed'],
            'status' => ['required'],
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->input('name');
        $usuario->status = $request->input('status');
    
        if($request->input('password') != '' || $request->input('password') != null)
        {
            $usuario->password = Hash::make($request->input('password'));
        }
        $usuario->save();

        return redirect('/usuario');
    }

    function delete($id)
    {
        $usuario = User::find($id);
        $usuario->status = 2;
        $usuario->save();

        return redirect('/usuario');
    }
}
