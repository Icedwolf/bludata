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
						<td>Fornecedores</td>
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
							<td><a href="{{ route("lista-fornecedores", $cliente->id) }}" class="btn btn-primary">Fornecedores</a></td>
							<td>
									<a href="{{ route('empresa.edit', $cliente->id) }}" class="action_edit"><i class="ti-pencil-alt"></i> Editar</a>
									|
									<a href="{{ route('empresa.destroy', $cliente->id) }}" class="action_destroy"><i class="ti-trash"></i> Remover</a>
									<form id="" method="post" action="{{ route('empresa.destroy', $cliente->id) }}">
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