@extends('layout.base')
@section('content')
<div class="row">
    <div class="col-md">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if( isset($client->id) )
            <form id="" method="post" action="{{ route('empresa.update', [$client->id]) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @else
            <form method="POST" action="{{ route('empresa.store') }}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="form-group">
                <label>UF <span class="text-danger">*</span></label>
                <select name="uf" class="form-control" id="uf" required>
                    <option value="" selected disabled>Estado:</option>
                    @foreach(config('project.estados') as $uf => $estado)
                    <option value="{{ $uf }}" {{ (isset($client) && $client->uf == $uf) || (old('uf') == $uf) ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nome Fantasia: <span class="text-danger">*</span></label>
                <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" placeholder="Nome Fantasia" required value="{{ isset($client) ? $client->nome_fantasia : old('nome_fantasia') }}">
            </div>
            <div class="form-group">
                <label>CNPJ <span class="text-danger">*</span></label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" required value="{{isset($client) ? $client->cnpj : old('cnpj') }}">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Cadastrar</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        $(function() {
            $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
        })
        $(document).ready(function() {
            var x = 0;
            
        });
        
    </script>
@endsection