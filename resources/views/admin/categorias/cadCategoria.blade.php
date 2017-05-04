@extends('layouts.admin')

@section('conteudo')
<div class='col-sm-12'>
    <h2 class="page-header text-info">
        Cadastro de Categorias        
    <a href="listCategoria" class="btn btn-danger pull-right">Cancelar</a>
    </h2>
</div>
<div class="panel panel-default ">
	<div class="panel-body">
  		@if(Session::has('mensagem_sucesso'))
			{!! 'OK' !!}
  		@endif
  		<div class="form-group">
			{!!Form::open(['route' => 'admin.saveCategoria', 'class'=>'form-horizontal'])!!}
				{!! Form::label('nome', 'Categoria', ['class'=>'input-group']) !!}
				{!! Form::input('text', 'nome', null, ['class'=>'form-control', 'autofocus', 'placeholder'=>'Nome']) !!}
				{!! Form::label('nome', 'Categoria Pai', ['class'=>'input-group']) !!}
				{{ Form::select('categoria_id', $listcategorias->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Categoria Principal']) }}
				{!! Form::submit('Salvar', ['class'=>'btn btn-primary input-group' ]) !!}
			{!!Form::close()!!}
		</div>	
	</div>
</div>

@stop