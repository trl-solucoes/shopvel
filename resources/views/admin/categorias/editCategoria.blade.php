@extends('layouts.admin')

@section('conteudo')
<div class='col-sm-12'>
    <h2 class="page-header text-info">
        Editando Categoria <span class="btn btn-success disabled">{{$listcategorias->nome}}</span>      
    <a href="{{ URL::previous() }}" class="btn btn-danger pull-right">Cancelar</a>
    </h2>
</div>
  		<div class="form-group">
			{!! Form::model($listcategorias, ['method'=>'PATCH', 'url'=>'admin/updtCategoria/'.$listcategorias->id]) !!}
				{!! Form::label('nome', 'Categoria', ['class'=>'input-group']) !!}
				{!! Form::text('nome', $listcategorias->nome, ['class'=>'form-control', 'autofocus', 'placeholder'=>'Nome']) !!}
				{!! Form::label('categoria_id', 'Categorias', ['class'=>'col-sm-2 control-label']) !!}
				{!! Form::select('categoria_id', $listcategorias->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Categoria Principal']) !!}
				{!! Form::submit('Alterar', ['class'=>'btn btn-primary input-group' ]) !!}
			{!!Form::close()!!}
		</div>	
	</div>
</div>

@stop