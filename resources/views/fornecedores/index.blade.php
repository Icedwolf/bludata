@extends('layout.base')
@section('content')

<div class="row">
<div class="col-sm-12">
	<h1 class="display-3">Fornecedores</h1>
	@isset($client)
		<h2 class="display-4">Empresa: {{$client->nome_fantasia}}</h2>
	@endisset
	<a href="{{ route('fornecedores.create') }}" class="btn btn-success mb-2">Cadastrar Novo</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>ID</td>
					<td>Nome</td>
					<td>CPF/CNPJ</td>
					<td>Criado</td>
					<td>Ações</td>
				</tr>
			</thead>
			<tbody>
				@foreach($fornecedores as $fornecedor)
					<tr>
						<td>{{$fornecedor->id}}</td>
						<td>{{$fornecedor->nome}}</td>
						<td>{{$fornecedor->cnpj}}</td>
						<td>{{$fornecedor->created_at}}</td>
						<td>
							<a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="action_edit"><i class="ti-pencil-alt"></i> Editar</a>
							|
							<a href="{{ route('fornecedores.destroy', $fornecedor->id) }}" class="action_destroy"><i class="ti-trash"></i> Remover</a>
							<form id="" method="post" action="{{ route('fornecedores.destroy', $fornecedor->id) }}">
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