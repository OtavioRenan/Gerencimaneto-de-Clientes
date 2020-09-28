@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($errors->any()) 
            <div class="alert alert-danger" role="alert">                                                    
                <span>{{$errors->first()}}</span>
            </div>   
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="thumbnail" action="{{URL::to('/clientes/update', $cliente->id)}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>                        
                        <div class="form-group">
                            <label>NOME:</label>
                            <input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}"/>
                        </div>                                                           
                        <div class="form-group">
                            <label>CPF:</label>                                    
                            <input type="text" name="cpf" class="form-control" value="{{ $cliente->cpf }}"/>
                        </div>
                        <div class="form-group">
                            <label>RG:</label>                                    
                            <input type="text" name="rg" class="form-control" value="{{ $cliente->rg }}"/>
                        </div>
                        <div class="form-group">
                            <label>UF:</label>
                            <select class="form-control" id="uf" name="uf"> 
                                @foreach ($estados as $e)
                                    @if($e->id_estado == $cliente->uf)
                                        <option value="{{$e->id_estado}}" selected>{{$e->sigla}}</option>
                                    @endif
                                    <option value="{{$e->id_estado}}">{{$e->sigla}}</option>
                                @endforeach                                  
                            </select>                            
                        </div>                            
                        <div class="form-group">
                            <label>DATA DE NASCIMENTO:</label>                                    
                            <div class='input-group date'>
                                <input name="nascimento" type='date' id="date" class="form-control" value="{{ $cliente->nascimento }}"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>TELEFONE:</label>
                            <input type="text" name="telefone" class="form-control" value="{{ $cliente->telefone }}"/>
                        </div>                            
                        <div class="box-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-success pull-right">
                                <i class="fas fa-plus-square"></i>
                                <span>ATUALIZAR</span>
                            </button>
                            <div></div>                                  
                            <a href="/clientes" type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="far fa-window-close"></i>
                                <span>CANCELAR</span>
                            </a>
                        </div>                              
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
