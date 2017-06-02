@extends('layouts.frente-loja')

@section('conteudo')
<div class="panel-body"></br>
@if(Session::has('mensagem_sucesso'))
      {!! 'OK' !!}
@endif
<div class="row col-md-12">
    <div id='num_prod' class="text-muted col-md-12">
        <h2 class="page-header text-info">Aproveite e leve também</h2>
    </div>
    @if(isset($marcas))
        @foreach ($marcas as $produto)
            <a href="{{route('produto.detalhes', $produto->id)}}">
            <div class="col-md-3" style="height:150px;">
                <div class="thumbnail">
                    <img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}" style="height: 70px;width:70px;">
                    <div class="caption">
                        <h3 class="teste">{{$produto->nome}}</h3>
                    </div>
                </div>
            </div>
            </a>
        @endforeach
    @else
        <h4 class="page-header">Sem sugestões</h4>
    @endif
</div>
<div class="row col-md-12">
    <div id='num_prod' class="text-muted col-md-9">
        <h2 class="page-header text-info">Carrinho de compras</h2> {{$itens->count()}} produtos no carrinho
    </div>
    <div class="col-md-5 row frete pull-right">
    @if(isset($valorfrete))
        <p class="alert alert-success col-md-5">Entrega: {{$prazo}} dias,</br>Valor: R$ {{$valorfrete}} <a href="{{route('carrinho.listar')}}" class="btn btn-primary col-md-offset-1 glyphicon glyphicon-refresh"></a></p>
    @else
            <form class="form-inline" action="{{route('frete.calcular')}}">
              <div class="form-group">
                <label for="frete">Calcular Frete: </label>
                <input type="number" class="form-control" id="cep" name="cep" placeholder="Insira o seu CEP">
              </div>
              <button type="submit" class="btn btn-primary">Calcular</button>
            </form>
        </div>
    @endif
    <a id="esvaziar" href="{{route('carrinho.esvaziar')}}" class="btn btn-warning col-sm-2">
        Esvaziar carrinho
    </a>
</div>
<hr/>
<table id="dsTable" class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Produto</th>
            <th class="text-right">Quantidade</th>
            <th class="text-right">Valor Unitário</th>
            <th class="text-center">Acoes</th>
            <th class="text-right">Total do item</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)

        <tr>
            <td>
                <img src="{{route('imagem.file',$item->produto->imagem_nome)}}" alt="{{$item->produto->imagem_nome}}" style="width:150px;" >
            </td>
            <td>
                <a href="{{route('produto.detalhes', $item->produto->id)}}">
                    {{$item->produto->nome}}
                </a>
            </td>
            <td class="text-center">
                {{$item->qtde}}
            </td>
            <td class="text-center">
                {{number_format($item->produto->preco_venda, 2, ',', '.')}}
            </td>
            <td class="text-center">
                <a href="{{route('carrinho.remover-item', $item->produto->id)}}"
                        class="btn btn-danger btn-xs">
                    Remover Item
                    </a>
            </td>
            <td class="text-right">
                {{number_format($item->produto->preco_venda * $item->qtde, 2, ',', '.')}}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right">
                Total
            </td>
            <td >
                <h4 id="total" class="text-right text-danger">
                    {{number_format($total,2,',','.')}}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">
                Finalizar compra
            </td>
            <td>
                @if (Auth::guest())
                    <a href="{{route('carrinho.finalizar-compra')}}"
                        class="btn btn-success pull-right">
                           Faça seu login para finalizar a compra
                    </a>
                @else
                    <a href="{{route('carrinho.finalizar-compra')}}"
                        class="btn btn-success pull-right">
                           Pagar
                    </a>
                @endif
            </td>
        </tr>
    </tfoot>
</table>
</div>
@stop