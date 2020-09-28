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
                    <form class="thumbnail" action="{{URL::to('/usuario/update', $usuario->id)}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>                        
                        <div class="form-group">
                            <label>NOME:</label>
                            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}"/>
                        </div>                                                           
                        <div class="form-group">
                            <label>E-MAIL:</label>
                            <input type="text" name="email" class="form-control" placeholder="{{$usuario->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>STATUS:</label>
                            <select class="form-control" id="status" name="status">                                
                                @foreach ($status as $s)
                                    @if ($usuario->status == $s->id)
                                        <option value="{{$s->id}}" selected>{{$s->nome}}</option>
                                    @else
                                        <option value="{{$s->id}}">{{$s->nome}}</option>
                                    @endif                                    
                                @endforeach                                  
                            </select>                            
                        </div> 
                        <div class="form-group">
                            <label>SENHA:</label>
                            <input type="password" name="password" class="form-control" placeholder="*******">
                        </div> 
                        <div class="form-group">
                            <label>CONFIRME A SENHA</label>
                            <input class="form-control" placeholder="*******" id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">
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
