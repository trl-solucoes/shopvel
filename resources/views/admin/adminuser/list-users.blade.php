@extends ('layouts.admin')
@section('conteudo')
<h1>Gerenciamento de Usuários</h1>
<div class="table-responsive col-md-10 col-md-offset-1 ">
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th class="text-center info">Nome</th>
				<th class="text-center info">Email</th>
				<th class="text-center info col-md-2">Ação</th>
			</tr>
		</thead>
		<tbody>
            <tr class="odd gradeX ">
		@foreach($usuarios as $user)
				<td class="text-center">{{$user->name}}</td>
				<td class="text-center">{{$user->email}}</td>
				<td class="text-center" ><a class="glyphicon glyphicon-pencil col-md-3 col-md-offset-3 btn busca-btn btn-sm" href="#myModal" data-toggle="modal" onclick="editar({{$user}})" ></a><a class="glyphicon glyphicon-trash col-md-3 col-md-offset-1 btn btn-danger btn-sm" href="#" onclick="remover({{$user->id}},'{{$user->name}}')"></a></td>
			</tr>
			<br>
		@endforeach
	</table>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edição de usuário</h4>
      </div>
      <div class="modal-body">
			<form class="form-horizontal" id="form_edit_user" method="POST" action="{{ url('admin/editUser') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label class="control-label col-sm-3" for="nome">Nome</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="nome" id="nome" value="{{$user->name}}">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="cpf">CPF</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="cpf" id="cpf" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Email</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="email" id="email" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="endereco">Endereço</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="endereco" id="endereco">
					</div>
				</div>
				<div class="form-group">
					<button class="control-label btn busca-btn col-md-2 col-md-offset-1" type="button" id="altSenha">Alterar senha</button>
					<div class="col-sm-9">
						<input type="hidden" class="form-control" name="senha" id="senha" placeholder="informe a nova senha">
					</div>
				</div>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" onClick='resetForms();'><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
			</form>
      </div>
      <!--<div class="modal-footer">
        
      </div>-->
    </div>

  </div>
</div>	
<!-- /. Modal -->

        
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
	function editar(user){
		$('#nome').val(user.name);
		$('#email').val(user.email);
		$('#cpf').val(user.cpf);
		$('#endereco').val(user.endereco);
		$('#id').val(user.id);
		$('#altSenha').on("click",function(){
			$('#senha').attr('type','password');
		});
		$('#senha').attr('type','hidden');
	}

</script>
@stop