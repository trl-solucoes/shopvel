@extends('layouts.frente-loja')

@section('conteudo')
<div class="col-md-12 row panel-body">
<div class="col-md-12">
    <div class="col-md-6">
        <h2>Finalizar compra</h2>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <h4>
                {{$itens->count()}} tipo(s) de produto(s) no carrinho
                <p class="text-right">
                    Total 
                        <h4 class="text-right text-danger">
                            {{number_format($total,2,',','.')}}
                        </h4>
                </p>
        </h4>
    </div>
</div>
<table class="table table-striped">
        <thead>
            <th></th>
            <th>Produto</th>
            <th class="text-center">Quantidade</th>
            <th class="text-center">Valor Unitário</th>
            <th class="text-center">Acoes</th>
            <th class="text-center">Avaliar</th>
        </thead>
        @foreach($itens as $item)
        <tr>
            <td class="col-md-3 text-center">
                <img src="{{route('imagem.file',$item->produto->imagem_nome)}}" alt="{{$item->produto->imagem_nome}}" style="width:150px;" >
            </td>
            <td class="col-md-3">
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
                class="btn btn-danger btn-xs">Remover item </a>
            </td>
            <td class="text-center">
                <button type="button" data-id='{{ $item->produto->id }}' class='btn btn-success btn-sm btn-avalie'>Avalie</button>
               
                <!-- avaliar por botão Avalie ou apos clicar no botão finalizar compra -->
            </td>
        </tr>
        @endforeach
        <tr>
            <td>
                @if (Auth::guest())
                <a href="{{route('carrinho.finalizar-compra')}}"
                   class="btn btn-success pull-right">
                    Faça seu login para finalizar a compra
                </a>
                @else
                @if(isset($pagseguro))
                <a href="{{$pagseguro['info']->getLink()}}" class="btn btn-success pull-right">
                    Pagar com PagSeguro
                </a>
                @else
                <div class="alert alert-danger pull-right">
                    Erro ao conectar com PagSeguro, por favor tente novamente em alguns minutos!
                </div>
                <a href="" class="btn btn-primary pull-right">Armazene seu Pedido</a>
                @endif
                @endif
            </td>
        </tr>
</table>
</div>
@stop