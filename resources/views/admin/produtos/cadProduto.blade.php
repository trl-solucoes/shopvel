@extends('layouts.admin')

@section('conteudo')

<div class="panel panel-default ">
  	<div class="panel-heading">
    	<h2 class="page-header text-info">
        Cadastro de Produtos
    <a href="listProduto" class="btn btn-danger pull-right">Cancelar</a>
    </h2>
  	</div>
  	<div class="panel-body">
  		@if(Session::has('mensagem_sucesso'))
			{!! mensagem_sucesso !!}
  		@endif
		<div class="form-group">
				{!! Form::open(['route' => 'admin.saveProduto', 'class'=>'form-horizontal', 'files'=> true]) !!}
					<div  class="form-group col-md-12">
    					<div class="col-md-5">
							{!! Form::label('nome', 'Produto', ['class'=>'col-sm-2 forml-label']) !!}
							{!! Form::input('text', 'nome', null, ['class'=>'form-control', 'placeholder'=>'Nome', 'required'=>'required']) !!}
						</div>
						<div class=" col-md-6 col-md-offset-1">
							{!! Form::label('descricao', 'Descrição', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('textarea', 'descricao', null, ['class'=>'form-control', '', 'placeholder'=>'Descrição', 'required'=>'required']) !!}
						</div>	
					</div>			        
					<div  class="form-group col-md-12">
    					<div class="col-md-5">
							{!! Form::label('marca_id', 'Marca', ['class'=>'col-sm-2 form-label']) !!}
					        {!! Form::select('marca_id', $listmarcas->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Marca', 'required'=>'required']) !!}
						</div>
						<div class=" col-md-6 col-md-offset-1">
							{!! Form::label('categoria_id', 'Categoria', ['class'=>'col-sm-2 form-label']) !!}
					        {!! Form::select('categoria_id', $listcategorias->lists('nome','id'), null, ['class'=>'form-control', 'placeholder'=>'Categoria']) !!}
						</div>
					</div>
					<div  class="form-group col-md-12">
    					<div class="col-md-5">
							{!! Form::label('avaliacao_qtde', 'Avaliação Quantidade', ['class'=>'col-sm-4 form-label']) !!}
							{!! Form::input('number', 'avaliacao_qtde', null, ['class'=>'form-control', '', 'placeholder'=>'Avaliação Quantidade', 'required'=>'required']) !!}
						</div>
						<div class=" col-md-6 col-md-offset-1">
							{!! Form::label('avaliacao_total', 'Avaliação total', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('number', 'avaliacao_total', null, ['class'=>'form-control', '', 'placeholder'=>'Avaliação total', 'required'=>'required']) !!}
						</div>
					</div>
					<div  class="form-group col-md-12">
    					<div class="col-md-5">
							{!! Form::label('preco_venda', 'Preço Venda', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('text', 'preco_venda', null, ['class'=>'form-control', '', 'placeholder'=>'Preço de Venda', 'required'=>'required']) !!}
						</div>
						<div class=" col-md-6 col-md-offset-1">
							{!! Form::label('qtde_estoque', 'Quantidade', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('number', 'qtde_estoque', null, ['class'=>'form-control', '', 'placeholder'=>'Quantidade', 'required'=>'required']) !!}
						</div>
					</div>
					<div  class="form-group col-md-12">
    					<div class="col-md-5">
							{!! Form::label('imagem_nome', 'Imagem', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('file', 'imagem_nome', null, ['class'=>'form-control', '', 'placeholder'=>'Nome da Imagem', 'required'=>'required']) !!}
						</div>
						<div class=" col-md-6 col-md-offset-1">
					        {!! Form::label('destacado', 'Destaque', ['class'=>'col-sm-2 form-label']) !!}
							{!! Form::input('checkbox', 'destacado', null, ['class'=>'form-control ']) !!}
						</div>
					</div>
					{!! Form::submit('Salvar Produto', ['class'=>'btn btn-primary input-group pull-right' ]) !!}

				{!! Form::close() !!}
		</div>	
	</div>
</div>

@stop
	