@extends('layouts.admin')

@section('conteudo')
<h2>Painel de controle - {{Auth::user()->name}}</h3>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="text-center">Total de pedidos</h3>
                </div>
                <div class="panel-body text-center">
                    <h1 class="text-info">
                        {{$qtdePedidos['total']}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="text-center">Pendentes de pagamento</h3>
                </div>
                <div class="panel-body text-center">
                    <h1 class="text-info">
                        {{$qtdePedidos['pendentes-pagamento']}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="text-center">Pagos</h3>
                </div>
                <div class="panel-body text-center">
                    <h1 class="text-info">
                        {{$qtdePedidos['pagos']}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="text-center">Finalizados</h3>
                </div>
                <div class="panel-body text-center">
                    <h1 class="text-info">
                        {{$qtdePedidos['finalizados']}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

@stop