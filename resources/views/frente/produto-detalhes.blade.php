@extends('layouts.frente-loja')

@section('conteudo')

<div class="row">
    <div class="col-sm-8">
        <div class="thumbnail">
            <img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}">
            <h1 class="page-header text-info">
                 {{$produto->nome}}
            </h1>
         </div>
    </div>
            @if ($produto->qtde_estoque > 0) 
            <h2 class="text-left text-info col-sm-5 " style="color:black;"> R$ {{number_format($produto->preco_venda, 2, ',', '.')}}</h2>
            <div class="col-sm-6  ">
                
                {{ Form::open (['route' => ['carrinho.adicionar', $produto->id]]) }}
                    {!! Form::label('qtd', 'Qtd.', ['class'=>'input-group']) !!}
                    {{ Form::text('qtde', 1, ['class'=>'col-sm-2 text-center']) }}
                    {{ Form::submit('Adicionar ao carrinho', ['class'=>'btn btn-primary btn-sm col-sm-5 btn-detail col-sm-offset-1']) }}
                {{ Form::close() }}
            </div>
        @else
            <h2 class="text-center text-warning"> Indisponível no momento</h2>
        @endif
        
    <div class="col-md-3 col-sm-6">
        <div class="text-center">
        @if ($produto->avaliacao_qtde > 0) 
            </br>
            Média de avaliações <br/>
            <h4 class="alert alert-success">
                {{$produto->avaliacao_total / $produto->avaliacao_qtde}}
            </h4>
        @else
            <span class="text-muted">Não avaliado</span>
        @endif
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <h4>Formas de pagamento</h4>
        PAGSEGURO AQUI
    </div>
</div>
<div class="row">
    <h3 class="page-header" style="color:red;">Descrição detalhada</h3>
    <div class="col-sm-11 text-justified" style="border:2px solid red;">
        {{$produto->descricao}}
    
    </div>

</div>
<br>
@stop