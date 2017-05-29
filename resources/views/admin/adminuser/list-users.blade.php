@extends ('layouts.admin')
@section('conteudo')
<h1>Gerenciamento de Usuários</h1>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th class="text-center info">Nome</th>
				<th class="text-center info">Email</th>
				<th class="text-center info col-md-2">Ação</th>
			</tr>
		</thead>
		<tbody>
            <tr class="odd gradeX">
		@foreach($usuarios as $user)
				<td class="text-center">{{$user->name}}</td>
				<td class="text-center">{{$user->email}}</td>
				<td class="text-center"><a class="glyphicon glyphicon-pencil col-md-3 btn busca-btn btn-sm" href="#"></a><a class="glyphicon glyphicon-trash btn btn-danger btn-sm" href="#" onclick="remover({{$user->id}},'{{$user->name}}')"></a></td>
			</tr>
			<br>
		@endforeach
	</table>
</div>
        
<!-- Janela para confirmação de excluão!-->
<script type="text/javascript">
	function remover(id,nome) {
		bootbox.confirm({
			title: 'Confirmação de exclusão',
			message: 'Deseja realmente excluír o usuário '+nome+'?',
			buttons: {
				'cancel': {
					label: 'Cancelar',
					className: 'btn-default pull-left'
				},
				'confirm': {
					label: 'Sim',
					className: 'btn-danger pull-right'
				}
			},
			callback: function(result) {
				if (result) {
					location.href='removeUser/'+id;
				}
			}
		});
	}
</script>
@stop