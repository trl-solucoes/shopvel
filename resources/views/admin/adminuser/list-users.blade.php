@extends ('layouts.admin')
@section('conteudo')
<h1>GERENCIAMENTO DE USUÁRIOS</h1>
<table class="table  table-bordered table-hover text-uppercase">
<th class="text-center info">Nome</th>
<th class="text-center info col-md-2">Ação</th>
@foreach($usuarios as $user)
	<tr>
		<td class="bold">{{$user->name}}</td>
		<td class="text-center"><a class="glyphicon glyphicon-pencil col-md-2 " href="#"></a><a class="glyphicon glyphicon-trash col-md-2" href="#" onclick="remover({{$user->id}},'{{$user->name}}')"></a></td>
	</tr>
	<br>
@endforeach
</table>
        
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