@extends('layouts.frente-loja')
@section('conteudo')
<script>
    $(document).ready(function(){
        $("#drop_marca").hide();
        $("#drop_categoria").hide();
        $("#oferta").hide();
    });
</script>
<div class='col-sm-12'>
    <h2 class="page-header text-muted">
        Sobre o projeto SHOPPVEL
    </h2>
</div>
<!-- Jumbotron -->
<div class="jumbotron">
    <h1>Shoppvel</h1>
    <p class="lead">Sistema de loja virtual.</p>
    <p>
        Projeto desenvolvido para a disciplina de e-commerce, como um demonstrativo
        de desenvolvimento de sistema evolutivo, e aplicação prática dos conceitos
        adquiridos durante o curso.
    </p>
    <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
</div>
@stop
