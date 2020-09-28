@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/clientes" type="button" class="btn btn-primary btn-lg btn-block">CLIENTES</a>
                    <a href="/usuario" type="button" class="btn btn-secondary btn-lg btn-block">USUÁRIOS</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
