@extends('layouts.frente-loja')

@section('conteudo')
<div class="container">
    <div class="row">
        
        @include('auth.login.form')
        
        @include('auth.register.form')

    </div>
</div>
@endsection
