@extends('layout.base')
@section('content')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Contacts</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>UF</td>
          <td>Nome Fantasia</td>
          <td>CNPJ</td>
          <td colspan = 2>Actions</td>
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
                <a href="{{ route('cliente.edit',$cliente->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('cliente.destroy', $cliente->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection