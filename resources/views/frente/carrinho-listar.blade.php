@extends('layouts.frente-loja')

@section('conteudo')
<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
<h2>Carrinho de compras</h2>
<div class='row'>
    <div id='num_prod' class="text-muted col-sm-8">
        {{$itens->count()}} produtos no carrinho
    </div>
    <a id="esvaziar" href="{{route('carrinho.esvaziar')}}" class="btn btn-warning col-sm-2 pull-right">
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
            <td class="text-right">
                {{$item->qtde}}
            </td>
            <td class="text-right">
                {{number_format($item->produto->preco_venda, 2, ',', '.')}}
            </td>
            <td class="text-center">
                <button  onclick="deleteRow(this)" class="btn btn-danger ">X</button>
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

@stop
<script type="text/javascript">
     function deleteRow(row){
      var d = row.parentNode.parentNode.rowIndex;
      var retirar=row.parentNode.nextElementSibling.firstChild.nodeValue;
      var total=document.getElementById('total').firstChild.nodeValue;
      var sub=parseInt(total)-parseInt(retirar);
      var num_prod=document.getElementById('num_prod').firstChild.nodeValue;
      document.getElementById('num_prod').innerHTML=parseInt(num_prod)-1+' produtos no carrinho';
      document.getElementById('total').innerHTML=sub;
      document.getElementById('dsTable').deleteRow(d);
      document.getElementById('esvaziar').style.display = 'none';
   }
</script>