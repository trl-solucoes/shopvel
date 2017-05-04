@extends('layouts.admin')

@section('conteudo')
<h2>Perfil - {{Auth::user()->name}} - {{Auth::user()->role}}</h3>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-2 text-uppercase text-muted">Nome de usuário</div>
            <div class="col-sm-10">{{Auth::user()->name}}</div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-2 text-uppercase text-muted">E-Mail</div>
            <div class="col-sm-10">{{Auth::user()->email}}</div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-2 text-uppercase text-muted">CPF</div>
            {{-- Utiliza preg_replace para formatar o CPF que está sem pontos e traços no banco --}}
            <div class="col-sm-10">{{preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/','$1.$2.$3-$4',Auth::user()->cpf)}}</div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-2 text-uppercase text-muted">Endereço</div>
            <div class="col-sm-10">{{Auth::user()->endereco}}</div>
        </div>
    </div>
</div>

@stop