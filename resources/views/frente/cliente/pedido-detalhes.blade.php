@extends('layouts.cliente')

@section('conteudo')
<h2>Pedido - {{$pedido->data_venda->format('d/m/Y H:i')}} </h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Data</th>
            <th class="text-right">Valor</th>
            <th class="text-right">Método de Pagamento</th>
            <th class="text-right">Status no Pagseguro</th>
            <th class="text-right">Status Local</th>
            <th class="text-right">Enviado / Finalizado</th>
            <th class="text-right">Id no Pagseguro</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <a href="{{route('cliente.pedidos', $pedido->id)}}">
                    {{$pedido->data_venda->format('d/m/Y H:i')}}
                </a>
            </td>
            <td>
                {{number_format($pedido->valor_venda, 2, ',', '.')}}
            </td>
            <td class="text-right">
                {{$pedido->metodo_pagamento}}
            </td>
            <td class="text-right">
                {{$pedido->status_pagamento}}
            </td>
            <td class="text-right small">
                {!! $pedido->pago && $pedido->enviado == FALSE 
                    ? '<span class="text-primary">PRONTO PARA ENVIAR</span>' 
                    : '<b class="text-warning">Aguardando atualização de status de pagamento</b>'
                !!}
            </td>
            <td class="text-right small">
                {!! $pedido->enviado 
                    ? '<span class="text-success">ENVIADO / FINALIZADO</span>' 
                    : '<b class="text-warning">Aguardando atualização de status de pagamento</b>'
                !!}
            </td>
            <td class="text-right text-muted small">
                {{$pedido->pagseguro_transaction_id}}
            </td>
        </tr>
    </tbody>
</table>

<h3>Itens - {{$pedido->itens->count()}}</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Produto</th>
            <th class="text-right">Quantidade</th>
            <th class="text-right">Valor Unitário</th>
            <th class="text-right">Total do item</th>
            <th class="text-right">Avaliar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedido->itens as $item)
        <tr>
            <td>
                <img src="{{route('imagem.file',$item->produto->imagem_nome)}}" alt="{{$item->produto->imagem_nome}}" style="width:150px;" >
            </td>
            <td>
                <a href="{{route('produto.detalhes', $item->produto->id)}}">
                    {{$item->produto->nome}}
                </a>
            </td>
            <td class="text-right">
                {{$item->qtde}}
            </td>
            <td class="text-right">
                {{number_format($item->produto->preco_venda, 2, ',', '.')}}
            </td>
            <td class="text-right">
                {{number_format($item->produto->preco_venda * $item->qtde, 2, ',', '.')}}
            </td>
            <td class="col-sm-2 text-right">
                @if($item->avaliado)
                    {{ number_format($item->produto->avaliacao_total / $item->produto->avaliacao_qtde, 2) }}
                @else
                    {{ Form::open (['route' => ['cliente.avaliar', $item->id]]) }}
                        {{ Form::text('avaliacao', null, ['class'=>'col-sm-12']) }}
                        {{ Form::submit('Avaliar', ['class'=>'btn btn-primary btn-sm col-sm-12']) }}
                    {{ Form::close() }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop