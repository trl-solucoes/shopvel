@extends('layouts.frente-loja')
@section('conteudo')
<script>
    $(document).ready(function(){
        $("#drop_marca").hide();
        $("#drop_categoria").hide();
        $("#oferta").hide();
    });
</script>
<div class="container">
    <div class="row">
        
        @include('auth.login.form')
        @include('auth.register.form')

    </div>
</div>

@endsection
