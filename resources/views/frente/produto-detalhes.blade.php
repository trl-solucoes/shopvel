@extends('layouts.frente-loja')
@section('conteudo')
<div class="panel-body">
    <div class="row col-md-12">
        <div class="col-md-3">
            <h3 class="page-header text-info">{{$produto->nome}}</h3>
            <div class="thumbnail">
                <img src="{{route('imagem.file',$produto->imagem_nome)}}" alt="{{$produto->imagem_nome}}"  data-zoom-image="{{route('imagem.file',$produto->imagem_nome)}}" id="img-produto">
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
        <div class="text-center col-md-4 col-md-offset-1 row aval">
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
        <div class="text-center col-md-4 row">
            <h4>Formas de pagamento</h4>
            PAGSEGURO AQUI
        </div>
        <div class="text-center col-md-4 row aval">
            <h4>Compartilhe essa oferta!!!</h4>
            <div>
                <a href="https://twitter.com/share" class="twitter-share-button btn btn-default" data-size="large" data-dnt="true">Tweet</a> 
                    <script>
                        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
                        </script>
                <!-- Your like button code -->
                <div class="fb-share-button" data-href="https://www.facebook.com/Shoppvel-114194329168398/" data-layout="button" data-size="large" data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"></a>
                </div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                </script>

                <a href="https://plus.google.com/share?url=https://www.facebook.com/Shoppvel-114194329168398/" onclick="javascript:window.open(this.href, '', 'enubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Google+"><i class="fa fa-google-plus"></i>Google+</a>
            </div>
        </div>
    </div>
<div class="row col-md-10 col-md-offset-1">
    <h3 class="page-header" style="color:red;">Descrição detalhada</h3>
    <div class="col-sm-12 text-justified" style="border:2px solid red;">
        {{$produto->descricao}}
    
    </div>

</div>
<br>
</div>
<script type="text/javascript">
    $("#img-produto").elevateZoom({
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            lensFadeIn: 500,
            lensFadeOut: 500
});
</script>
@stop