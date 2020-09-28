@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content card">                    
                    <div class="d-flex justify-content-end">
                        <button type="button" class="close pt-2 pr-2" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>                                
                    </div>                        
                    <div class="card-body">                                                        
                        <form class="thumbnail" action="{{URL::to('/usuario/create')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div class="form-group">
                                <label>NOME:</label>
                                <input type="text" name="name" class="form-control">
                            </div>                                
                            <div class="form-group">
                                <label>E-MAIL:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>SENHA:</label>
                                <input type="password" name="password" class="form-control" placeholder="Senha">
                            </div> 
                            <div class="form-group">
                                <label>CONFIRME A SENHA</label>
                                <input class="form-control" placeholder="Senha" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div> 
                            <div class="box-footer d-flex justify-content-between">
                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fas fa-plus-square text-body"></i>
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
        <div class="col-md-8">
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
                                <th scope="col">E-MAIL</th>
                                <th scope="col">STATUS</th>                          
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead><br>
                        <tbody>
                            @foreach($usuarios as $c)
                            <tr class="box">
                                <th scope="col">{{$c->name}}</th>                                                        
                                <th scope="col">{{$c->email}}</th>   
                                <th scope="col">
                                    @foreach ($status as $s)
                                        @if ($c->status == $s->id)
                                            {{$s->nome}}                                            
                                        @endif                                        
                                    @endforeach
                                </th>     
                                <th scope="col">                            
                                    <form action="{{URL::to('/usuario/delete', $c->id )}}" method="POST">
                                        <button type="submit" class="btn btn-danger pull-right border border-secondary text-dark" >
                                            @method('DELETE')
                                            @csrf
                                            <i class="fas fa-trash-alt"></i>
                                            <span> EXCLUIR </span>                        
                                        </button>                        
                                    </form>
                                </th>
                                <th scope="col">
                                    <a type="submit" href="{{URL::to('/usuario/edit', $c->id )}}" class="btn btn-warning pull-right text-dark" >
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
