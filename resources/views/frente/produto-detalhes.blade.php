@extends('layouts.frente-loja')
@section('conteudo')

<div class="panel-body">
    <div class="row col-md-12">
        <div class="col-md-6">
            <div class="thumbnail">
                <img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}">
                <h1 class="page-header text-info">
                     {{$produto->nome}}
                </h1>
             </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
                @if ($produto->qtde_estoque > 0) 
                    <h2 class="text-left text-info row" style="color:black;"> R$ {{number_format($produto->preco_venda, 2, ',', '.')}}
                    </h2>
                    </br>
                    <div class="col-md-12">                
                        {{ Form::open (['route' => ['carrinho.adicionar', $produto->id]]) }}
                            {!! Form::label('qtd', 'Qtd.', ['class'=>'input-group']) !!}
                            {{ Form::number('qtde', 1, ['class'=>'col-sm-2 text-center','min'=>'1','max'=>$produto->qtde_estoque]) }}
                            {{ Form::submit('Adicionar ao carrinho', ['class'=>'btn btn-primary btn-sm col-sm-5 btn-detail col-sm-offset-1']) }}
                        {{ Form::close() }}
                    </div>
                @else
                    <h2 class="text-center text-warning"> Indisponível no momento</h2>
                @endif
        </div>
        </hr>
        <div class="text-center col-md-6 row aval">
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
        <h4>Formas de pagamento</h4>
        PAGSEGURO AQUI
    </div>
<div class="row col-md-11 col-md-offset-1">
    <h3 class="page-header" style="color:red;">Descrição detalhada</h3>
    <div class="col-sm-11 text-justified" style="border:2px solid red;">
        {{$produto->descricao}}
    
    </div>

</div>
<br>
</div>
@stop