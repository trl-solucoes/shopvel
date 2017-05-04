@extends('layouts.admin')

@section('conteudo')
<div class="panel-body">
  	@if(Session::has('mensagem_sucesso'))
		{!! 'OK' !!}
  	@endif
  	<h2 class="page-header text-info">Produtos
        <a href="{{ route('admin.cadProduto') }}" class="btn busca-btn btn-sm pull-right">
		            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Produto 
		</a>
    </h2>
    <div class="table-responsive">
	  	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	  		<thead>
	  			<tr>
		            <th>id</th>
		            <th>Nome</th>
		            <th>Quantidade</th>
		            <th>Marca</th>
		            <th>Categoria</th>
		            <th>Ações</th>
		        </tr>
		    </thead>
		    <tbody>
		    @foreach($listprodutos as $prod)
		    <tr class="odd gradeX">
		        <td>{{$prod->id}}</td>
		        <td>{{$prod->nome}}</td>
		        <td>{{$prod->qtde_estoque}}</td>
		        <td>{{$prod->marca['nome']}}</td>
		        <td>{{$prod->categoria['nome']}}</td>
		        
		        <td>
		            <a href="editProduto/{{$prod->id}}" class="btn busca-btn btn-sm">editar</a>
		            <a href="deleteProduto/{{$prod->id}}" class="btn btn-danger btn-sm">excluir</a>
		        </td>
		    </tr>
		    @endforeach
		    </tbody>
		</table>
		{{$listprodutos->links()}}
	</div>		
</div>
@stop