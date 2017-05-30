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
@stop