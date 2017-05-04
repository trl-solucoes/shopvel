@extends('layouts.admin')

@section('conteudo')

<div class="panel panel-default ">
  	<div class="panel-heading">
    	<h2 class="page-header text-info">
        Editar Produto <span class="btn btn-success disabled">{!! $produto->nome !!}</span>
    <a href="{{ URL::previous() }}" class="btn btn-danger pull-right">Cancelar</a>
    </h2>
  	</div>
  	<div class="panel-body">
  		@if(Session::has('mensagem_sucesso'))
			{!! mensagem_sucesso !!}
  		@endif
		<div class="form-group">
{!! Form::model($produto, ['method'=>'PATCH', 'url'=>'admin/updtProduto/'.$produto->id]) !!}
					{!! Form::label('nome', 'Produto', ['class'=>'col-sm-2 forml-label']) !!}
					{!! Form::input('text', 'nome', null, ['class'=>'form-control', 'placeholder'=>'Nome']) !!}

					{!! Form::label('descricao', 'Descrição', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('textarea', 'descricao', null, ['class'=>'form-control', '', 'placeholder'=>'Descrição']) !!}

					{!! Form::label('marca_id', 'Marca', ['class'=>'col-sm-2 form-label']) !!}
			        {!! Form::select('marca_id', $listmarcas->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Marca']) !!}

					{!! Form::label('imagem_nome', 'Imagem', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('file', 'imagem_nome', null, ['class'=>'form-control', '', 'placeholder'=>'Nome da Imagem']) !!}

					{!! Form::label('avaliacao_qtde', 'Avaliação Quantidade', ['class'=>'col-sm-4 form-label']) !!}
					{!! Form::input('number', 'avaliacao_qtde', null, ['class'=>'form-control', '', 'placeholder'=>'Avaliação Quantidade']) !!}

					{!! Form::label('avaliacao_total', 'Avaliação total', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('number', 'avaliacao_total', null, ['class'=>'form-control', '', 'placeholder'=>'Avaliação total']) !!}

					{!! Form::label('preco_venda', 'Preço Venda', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('text', 'preco_venda', null, ['class'=>'form-control', '', 'placeholder'=>'Preço de Venda']) !!}

					{!! Form::label('qtde_estoque', 'Quantidade', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('number', 'qtde_estoque', null, ['class'=>'form-control', '', 'placeholder'=>'Quantidade']) !!}

					{!! Form::label('categoria_id', 'Categoria', ['class'=>'col-sm-2 form-label']) !!}
			        {!! Form::select('categoria_id', $listcategorias->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Categoria']) !!}

			        {!! Form::label('destacado', 'Destaque', ['class'=>'col-sm-2 form-label']) !!}
					{!! Form::input('checkbox', 'destacado', null, ['class'=>'form-control ']) !!}

					{!! Form::submit('Salvar', ['class'=>'btn btn-primary input-group' ]) !!}

				{!! Form::close() !!}
</div>	
	</div>
</div>

@stop
	