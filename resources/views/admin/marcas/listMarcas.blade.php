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
		            <button onclick="pegaId({{$marca->id}},'{{$marca->nome}}')" id="abrirModal" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal" >Excluir</button></td>
		        </td>
		    </tr>
		    @endforeach
		    </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span></button> 
                </div>  
                <div class="modal-body">
                   <h4 class="alert alert-danger" id="modalLabel">Deseja realmente excluir a marca <strong id="nomeExclui"></strong>?</h4>
                </div>
                <div class="modal-footer">
                    <a id="sim" href="" title="Confirmar" class="btn btn-danger ">Sim</a>
                  <a href="{{ route('admin.listMarca') }}" title="Cancelar" class="btn btn-success ">Não</a>
                </div>   
            </div>
        </div>
    </div>
  <script type="text/javascript">
    function pegaId(id,nome ){
      var idexcluir=id;
      var nomeExcluir=nome;
      sim.setAttribute("href","deleteMarca/"+idexcluir);
      document.getElementById("nomeExclui").innerHTML = nome;

    } 
</script>

@stop