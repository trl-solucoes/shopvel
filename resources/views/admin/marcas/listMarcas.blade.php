@extends('layouts.admin')

@section('conteudo')
<div class="panel panel-default ">
  	<div class="panel-body">
  	@if(Session::has('mensagem_sucesso'))
		{!! 'OK' !!}
  	@endif
  		<h2 class="page-header text-info">Marcas
	        <a href="{{ route('admin.cadMarcas') }}" class="btn busca-btn btn-sm pull-right">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Marca</a>
    	</h2>
	  	<div class="table col-md-12">
	  	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	  		<thead>
	  			<tr>
		            <th>id</th>
		            <th>Nome</th>
		            <th>Ações</th>
		        </tr>
		    </thead>
		    <tbody>
		    @foreach($listmarcas as $marca)
		    <tr class="odd gradeX">
		        <td>{{$marca->id}}</td>
		        <td>{{$marca->nome}}</td>
		        
		        <td>
		            <a href="editMarca/{{$marca->id}}" class="btn busca-btn btn-sm">editar</a>
		            <a href="deleteMarca/{{$marca->id}}" class="btn btn-danger btn-sm">excluir</a>
		        </td>
		    </tr>
		    @endforeach
		    </tbody>
		</table>
	</div>
</div>

@stop