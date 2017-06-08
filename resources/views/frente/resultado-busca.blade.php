@extends('layouts.frente-loja')
@section('conteudo')

@if(null != $produtos->total())
    <div class='col-sm-10'>
        <div class="page-header text-muted">
            {{$produtos->total()}} encontrado(s) com o termo de busca 
            <span class="label label-info">{{$termo}}</span>
        </div>
        <div class="row">
        <input type="hidden" value="{{$termo}}" id="termo">
        <a href="#" class="btn btn-primary" onclick="filtro('menor')">Menor preço</a>
        <a href="#" class="btn btn-primary">Maior preço</a>
        <a href="#" class="btn btn-primary">De A-Z</a>
        <a href="#" class="btn btn-primary">De Z-A</a>
    </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Produto</th>
                <th class="text-right">Valor Unitário</th>
                <th class="text-right">Disponibilidade</th>
                <th class="text-right">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)

            <tr>
                <td>
                    <img img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}"  data-zoom-image="{{route('imagem.file',$produto->imagem_nome)}}" class="img-produto" style="width:150px;" >
                </td>
                <td>
                    <a href="{{route('produto.detalhes', $produto->id)}}">
                        {{$produto->nome}}
                    </a>
                </td>
                <td class="text-right">
                    {{number_format($produto->preco_venda, 2, ',', '.')}}
                </td>
                <td class="text-right">
                    {{is_null($produto->qtde_estoque) ? "Não" : "Sim"}}
                </td>
                <td class="text-right">
                    {{$produto->avaliacao_total}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-sm-12 text-center">
        {!! $produtos->appends(['termo-pesquisa' => $termo])->links() !!}
    </div>
@else
    <div class='col-sm-12'>
        <div class="page-header text-muted">
            Nenhum produto encontrado com o termo de busca 
            <span class="label label-info">{{$termo}}</span>
        </div>
    </div>

@endif
<script type="text/javascript">
    $(".img-produto").elevateZoom({
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            lensFadeIn: 500,
            lensFadeOut: 500
});

    function filtro(condicao){
        var termo = $("#termo").val();
        var pesquisa = "condicao="+condicao;
        $.ajax({
            type: 'GET',
            url: "produto.filtrar",
            data: pesquisa,
            success:function(retorno){
                console.log(retorno);
            },
            error:function(retorno){
                console.log(retorno);
            }
        })
    }
</script>
@stop