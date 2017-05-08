@extends('layouts.admin')

@section('conteudo')
<div class="panel-body">
@if(Session::has('mensagem_sucesso'))
      {!! 'OK' !!}
      @endif
  <h2 class="page-header text-info">Categorias
              <a href="{{ route('admin.cadCategoria') }}" class="btn busca-btn btn-sm pull-right">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Categoria 
              </a>
    </h2>
  <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
              <tr>
                  <th>id</th>
                <th>Nome</th>
                <th>Categoria Pai</th>
                <th>Ações</th>
              </tr>
              </thead>
              <tbody>
                  <tr class="odd gradeX">
                    @foreach ($listcategorias as $cat)
                      <td>{{$cat->id}}</td>
                      <td>{{$cat->nome}}</td>
                      <td>{{is_null($cat->categoria_id) ? "" : $cat->pai['nome']}}</td>
                      <td><a href="editCategoria/{{$cat->id}}" class="btn busca-btn btn-sm">editar</a>
                          <a href="" class="btn btn-danger btn-sm">excluir</a>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
      </table>
  </div>
</div>                               
</div>
@stop
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

<script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});
</script>