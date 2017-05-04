@extends('layouts.frente-loja')

@section('conteudo')
<h2>Finalizar compra</h2>
<table class="table">
    <tr>
        <td>
            <h4>
                {{$itens->count()}} produto(s) no carrinho
            </h4>
        </td>
        <td class="text-right">
            Total
        </td>
        <td>
            <h4 class="text-right text-danger">
                {{number_format($total,2,',','.')}}
            </h4>
        </td>
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
            @endif
            @endif
        </td>
    </tr>
</table>
@stop