@extends('layout.base')
@section('content')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Empresas</h1>    
		<table class="table table-striped">
			<thead>
					<tr>
						<td>ID</td>
						<td>UF</td>
						<td>Nome Fantasia</td>
						<td>CNPJ</td>
						<td>Ações</td>
					</tr>
			</thead>
			<tbody>
					@foreach($clientes as $cliente)
					<tr>
							<td>{{$cliente->id}}</td>
							<td>{{$cliente->uf}}</td>
							<td>{{$cliente->nome_fantasia}}</td>
							<td>{{$cliente->cnpj}}</td>
							<td>
									<a href="{{ route('cliente.edit', $cliente->id) }}" class="action_edit"><i class="ti-pencil-alt"></i> Editar</a>
									|
									<a href="{{ route('cliente.destroy', $cliente->id) }}" class="action_destroy"><i class="ti-trash"></i> Remover</a>
									<form id="" method="post" action="{{ route('cliente.destroy', $cliente->id) }}">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
									</form>
							</td>
					</tr>
        @endforeach
    	</tbody>
  </table>
<div>
</div>
@endsection
@section('scripts')
<script>
$('table:not(.custom)').DataTable({
    responsive: true,
    aaSorting: [],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
    }
});
</script>
@endsection