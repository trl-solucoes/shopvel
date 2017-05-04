@extends('layouts.frente-loja')

@section('conteudo')
<div class='col-sm-12'>
    <h2 class="page-header text-info">
        Produtos da categoria {{$categoria->nome}}
    </h2>
</div>
@foreach ($categoria->produtos as $produto)
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{route('imagem.file',$produto->imagem_nome)}}" >
        <div class="caption">
            <h3>{{$produto->nome}}</h3>
            <h4 class="text-muted">{{$produto->marca['nome']}}</h4>
            <p>{{str_limit($produto->descricao,100)}}</p>
            <p><a href="{{route('produto.detalhes', $produto->id)}}" class="btn btn-primary" role="button">Detalhes</a></p>
        </div>
    </div>
</div>
@endforeach
@stop