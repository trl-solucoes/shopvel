@extends('layouts.frente-loja')
@section('conteudo')
<div class="col-md-12"><p> Alterar senha para o usuário <strong>{{$_GET['data']}}</strong></p> </div>
 <form method="post" action="{{ url('alteraSenha') }}">
 	 {{ csrf_field() }}
 	 <input type="hidden" name="id" value="{{$_GET['id']}}">
 	 <div class="form-group">
        <label class="col-md-2 control-label">Nova senha</label>
        <div class="col-md-12">
            <input type="password" class="form-control" name="senha">
        </div>
    </div>
    
   <button class=" btn btn-danger col-md-4 col-md-offset-4" type="submit">Alterar senha</button>
 </form>
@endsection