<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Cliente;
use App\Estado;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientes = Cliente::all();
        $estados = Estado::all();

        return view('clientes', compact('clientes', 'estados'));
    }

    public function create(Request $request)
    {
        if(ClienteController::menorDeIdade( $request['nascimento']) < 18)
        {
            return redirect()->back()->withErrors('Não é permitido o cadastro de menores de idade');
        }       
      
        $request->validate([
            'nome' => 'required|max:191',            
            'cpf' => 'required|unique:clientes',
            'telefone' => 'required',
            'nascimento' => 'required|date',
            'uf' => 'required',                        
        ]);

        if( $request['uf'] == 26){
            $request->validate([                
                'rg' => 'required|unique:clientes'                                        
            ]);
        }

        $request['id_user_create'] = Auth::user()->id;
        $request['id_user_update'] = Auth::user()->id;

        if(Cliente::create($request->all()))
        {
            return redirect('/clientes');
        }
    }

    public function delete($id){
        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->delete();
            return redirect('/clientes');
        }
    }
    
    public function edit($id){
        $cliente = Cliente::find($id);
        $estados = Estado::all();

        return view('clientes-edt', compact('cliente', 'estados'));
    }

    public function update(Request $request, $id){
        $cliente = Cliente::find($id);
        if($cliente){
            
            if(ClienteController::menorDeIdade( $request['nascimento']) < 18)
            {
                return redirect()->back()->withErrors('Não é permitido o cadastro de menores de idade');
            }       
        
            $request->validate([
                'nome' => 'required|max:191',            
                'cpf' => 'required',
                'telefone' => 'required',
                'nascimento' => 'required|date',
                'uf' => 'required',                        
            ]);

            if( $request['uf'] == 26){
                $request->validate([                
                    'rg' => 'required'                                        
                ]);
            }
            
            $cliente->id_user_update = Auth::user()->id;
            $cliente->nome = $request['nome'];
            $cliente->rg = $request['rg'];
            $cliente->cpf = $request['cpf'];
            $cliente->nascimento = $request['nascimento'];
            $cliente->uf = $request['uf'];
            $cliente->telefone = $request['telefone'];
            $cliente->save();
        }

        return redirect('/clientes');
    }

    public function menorDeIdade($dataNascimento)
    {
        $dia = date('d', strtotime($dataNascimento));
        $mes = date('m', strtotime($dataNascimento));
        $ano = date('Y', strtotime($dataNascimento));
        $diadonascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $idade = floor((((($hoje - $diadonascimento) / 60) / 60) / 24) / 365.25);

        //$atual = Carbon::now();
        return strval($idade);
    }
}
