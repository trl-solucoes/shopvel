@extends('layouts.admin')

@section('conteudo')
<div class='col-sm-12'>
    <h2 class="page-header text-info">
        Editando Marca <span class="btn btn-success disabled">{!! $marca->nome !!}</span>
        <a href="{{ URL::previous() }}" class="btn btn-danger pull-right">Cancelar</a>
    </h2>
</div>
<div class="panel-body">
  		@if(Session::has('mensagem_sucesso'))
			{!! 'OK' !!}
  		@endif
		<div class="form-group">
				{!! Form::model($marca, ['method'=>'PATCH', 'url'=>'admin/updtMarca/'.$marca->id]) !!}
	
					{!! Form::label('nome', 'Marca', ['class'=>'input-group']) !!}
					{!! Form::input('text', 'nome', null, ['class'=>'form-control', 'autofocus', 'placeholder'=>'Nome']) !!}

					{!! Form::submit('Salvar', ['class'=>'btn btn-primary input-group' ]) !!}

				{!! Form::close() !!}
		</div>	
	</div>
@stop