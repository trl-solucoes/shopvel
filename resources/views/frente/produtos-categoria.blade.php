@extends('layouts.frente-loja')

@section('conteudo')
<div class='col-sm-12'>
    <h2 class="page-header text-muted">
        Produtos da categoria {{$categoria->nome}}
    </h2>
</div>
@foreach ($categoria->produtos as $produto)
<a href="{{route('produto.detalhes', $produto->id)}}">
<div class="col-md-3" style="height:500px;">
    <div class="thumbnail">
        <img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}" style="height: 200px;width:200px;">
        <div class="caption">
            <h3 class="teste">{{$produto->nome}}</h3>
            <h4 class="text-muted">{{$produto->marca['nome']}}</h4>
            <p>{{str_limit($produto->descricao,100)}}</p>
        </div>
    </div>
</div>
</a>
@endforeach
@stop