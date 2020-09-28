@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content card">                    
                    <div class="d-flex justify-content-end">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>                                
                    </div>                        
                    <div class="card-body">                            
                        <form class="thumbnail" action="{{URL::to('/clientes')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div class="form-group">
                                <label>NOME:</label>
                                <input type="text" name="nome" class="form-control" value="{{ old('nome') }}"/>
                            </div>                                                           
                            <div class="form-group">
                                <label>CPF:</label>                                    
                                <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}"/>
                            </div>
                            <div class="form-group">
                                <label>RG:</label>                                    
                                <input type="text" name="rg" class="form-control" value="{{ old('rg') }}"/>
                            </div>
                            <div class="form-group">
                                <label>UF:</label>
                                <select class="form-control" id="uf" name="uf">
                                    <option value="" select>SELECIONE</option>
                                    @foreach ($estados as $e)
                                        <option value="{{$e->id_estado}}">{{$e->sigla}}</option>
                                    @endforeach                                  
                                </select>                            
                            </div>                            
                            <div class="form-group">
                                <label>DATA DE NASCIMENTO:</label>                                    
                                <div class='input-group date'>
                                    <input name="nascimento" type='date' id="date" class="form-control" value="{{ old('nascimento') }}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>TELEFONE:</label>
                                <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}"/>
                            </div>                            
                            <div class="box-footer d-flex justify-content-between">
                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fas fa-plus-square"></i>
                                    <span>CRIAR</span>
                                </button>
                                <div></div>                                  
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="far fa-window-close"></i>
                                    <span>CANCELAR</span>
                                </button>
                            </div>                              
                        </form>                            
                    </div>
                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal fade -->
    </div><!-- row -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a data-toggle="modal" data-target="#modalNovo" type="button" class="btn btn-primary btn-lg btn-block">NOVO</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any()) 
                        <div class="alert alert-danger" role="alert">                                                    
                            <span>{{$errors->first()}}</span>
                        </div>   
                    @endif  

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>                    
                                <th scope="col">NOME</th>                                                        
                                <th scope="col">CPF</th>
                                <th scope="col">RG</th>
                                <th scope="col">UF</th>
                                <th scope="col">NASCIMENTO</th>
                                <th scope="col">CRIADOR</th>
                                <th scope="col">ALTERADOR</th>
                                <th scope="col">CRIAÇÃO</th>
                                <th scope="col">ATUALIZAÇÃO</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead><br>
                        <tbody>
                            @foreach($clientes as $c)
                            <tr class="box">
                                <th scope="col">{{$c->nome}}</th>                                                        
                                <th scope="col">{{$c->cpf}}</th>   
                                <th scope="col">{{$c->rg}}</th>
                                <th scope="col">{{$c->uf}}</th>
                                <th scope="col">{{$c->data_convertida}}</th>
                                <th scope="col">{{$c->user_create}}</th>   
                                <th scope="col">{{$c->user_update}}</th>
                                <th scope="col">{{$c->data_criacao}}</th>
                                <th scope="col">{{$c->data_atualizacao}}</th>
                                <th scope="col">                            
                                    <form action="{{URL::to('/clientes/delete', $c->id )}}" method="POST">
                                        <button type="submit" class="btn btn-danger pull-right border border-secondary text-dark" >
                                            @method('DELETE')
                                            @csrf
                                            <i class="fas fa-trash-alt"></i>
                                            <span> EXCLUIR </span>                        
                                        </button>                        
                                    </form>
                                </th>
                                <th scope="col">
                                    <a type="submit" href="{{URL::to('/clientes/edit', $c->id )}}" class="btn btn-warning pull-right text-dark" >
                                        <i class="fas fa-edit"></i>
                                        <span> EDITAR </span>
                                    </a>
                                </th>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
