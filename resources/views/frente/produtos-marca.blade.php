@extends('layouts.frente-loja')

@section('conteudo')
<div class="col-md-12 row">
    <div class="col-md-2" id="oferta">
        <a href="{{route('oferta.listar')}}" class="btn btn-warning" style="text-decoration:none;">Oferta do dia</a>
    </div>
    <div class="dropdown col-md-3" id="drop_categoria">
       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Compre por Categoria
       <span class="caret"></span></button>
       <ul class="dropdown-menu">
            @foreach ($listcategorias as $cat)
                <li><a href="{{route('categoria.listar', $cat->id)}}" style="text-decoration:none;">{{$cat->nome}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="dropdown col-md-2" id="drop_marca">
       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Compre por Marca
       <span class="caret"></span></button>
       <ul class="dropdown-menu">
            @foreach ($listmarcas as $mar)
                <li><a href="{{route('marca.listar', $mar->id)}}" style="text-decoration:none;">{{$mar->nome}}</a></li>
            @endforeach
        </ul>
    </div>        
</div>
<div class='col-sm-12'>
    <h2 class="page-header text-muted">
        Produtos da marca {{$marca->nome}}
    </h2>
</div>
@foreach ($marca->produtos as $produto)
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