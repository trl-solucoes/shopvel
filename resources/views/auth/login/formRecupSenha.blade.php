@extends('layouts.frente-loja')
@section('conteudo')
<h1>Recuperação de Senha</h1>
<form class="form-horizonta"  method="POST" action="{{ url('recuperaSenha') }}">
{{ csrf_field() }}
	<label class="col-md-4 control-label">Informe seu email cadastrado:</label>
	<input type="mail" class="form-control" name="email">
	<br>
	<input class=" btn btn-primary col-md-1" type="submit" name="" value="Enviar">
	<br><br>
</form>

@endsection