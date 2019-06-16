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
            @if( isset($fornecedor->id) )
            <form id="" method="post" action="{{ route('fornecedores.update', [$fornecedor->id]) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @else
            <form method="POST" action="{{ route('fornecedores.store') }}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="content">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Empresa <span class="text-danger">*</span></label>
                            <select name="client_id" class="form-control" id="client_id" required>
                                <option value="" selected disabled>Empresas:</option>
                                @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{ (isset($fornecedor) && $fornecedor->client_id == $empresa->id) || (old('client_id') == $empresa->id) ? 'selected' : '' }}>{{ $empresa->nome_fantasia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label>Nome: <span class="text-danger">*</span></label>
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required value="{{ isset($fornecedor) ? $fornecedor->nome : old('nome') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm d-flex justify-content-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pessoa" id="inlineRadio1" value="fisica" {{ (isset($fornecedor) && $fornecedor->rg) || (old('pessoa') == 'fisica') ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Pessoa Física</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pessoa" id="inlineRadio2" value="juridica"{{ (isset($fornecedor) && !$fornecedor->rg) || (old('pessoa') == 'juridica') ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">Pessoa Jurídica</label>
                    </div>
                </div>
            </div>
            <div class="row d-none" id="juridica">
                <div class="col-sm">
                    <div class="form-group">
                        <label>CNPJ <span class="text-danger">*</span></label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" value="{{isset($fornecedor) && !$fornecedor->rg ? $fornecedor->cnpj : old('cnpj') }}">
                    </div>
                </div>
            </div>
            <div class="row d-none" id="fisica">
                <div class="col-sm">
                    <div class="form-group">
                        <label>CPF <span class="text-danger">*</span></label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" value="{{ isset($fornecedor) && $fornecedor->rg ? $fornecedor->cnpj : old('cnpj') }}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>RG <span class="text-danger">*</span></label>
                        <input type="text" name="rg" id="rg" class="form-control" placeholder="00.000.000-00" value="{{isset($fornecedor) ? $fornecedor->rg : old('rg') }}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>Nascimento <span class="text-danger">*</span></label>
                        <input type="date" name="nascimento" class="form-control" value="{{isset($fornecedor) ? $fornecedor->nascimento : old('nascimento') }}">
                    </div>
                </div>
            </div>
            <div class="envia d-none">
                <div class="telefones">
                    <div class="row">
                        <div class="col-sm" id="telefone_0">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control telefone" placeholder="(00) 00000-0000" name="telefone[]">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="add">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@isset($telefones)
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
                <td>telefone</td>
                <td>#</td>
            </tr>
        </thead>
        <tbody>
            @foreach($telefones as $telefone)
                <tr>
                    <td>{{$telefone->id}}</td>
                    <td>{{$telefone->telefone}}</td>
                    <td>
                        <a href="{{ route('fornecedor.detroy.telefone', $telefone->id) }}" class="btn btn-danger"><i class="ti-trash"></i> Remover</a>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
@endisset


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('.telefone').mask(SPMaskBehavior, spOptions);
            $('#rg').mask('00.000.000-00', {reverse: true});
            //adiciona campos de telefone
            $('#add').click(function() {
                $('.telefones').append(
                    '<div class="row">' +
                        '<div class="col-sm">' +
                            '<div class="input-group mb-3">' +
                                '<input type="text" class="form-control telefone" name="telefone[]" placeholder="(00) 00000-0000">' +
                                '<button class="btn btn-danger remover" type="button">Remover</button>'+
                            '</div>' +
                        '</div>' +
                    '</div>'
                );
                $('.telefone').mask(SPMaskBehavior, spOptions);
                //seleciona o ultimo campo de telefone
                $('input[type="text"]:last').focus();
            });
            //remove o campo de telefone selecionado
            $('.telefones').on("click",".remover", function(e){ //user click on remove field
                e.preventDefault();
                $(this).closest('.row').remove();
            })
            //troca de tipo de formulários
            $('input:radio[name="pessoa"]').change(function(){
                definePessoa($(this).val());
            });
            function definePessoa(pessoa) {
                if($('.envia').hasClass('d-none')) {
                    $('.envia').removeClass('d-none');
                }
                var outra = (pessoa == 'fisica') ? 'juridica' : 'fisica';
                $('#' + pessoa).removeClass('d-none');
                if(!$('#' + outra).hasClass('d-none')) {
                    $('#' + outra).addClass('d-none');
                    $('#' + outra).find(':input').val('');
                }
            }
            console.log($('#fisica').is(':checked'));
            if($('#inlineRadio1').is(':checked')) {
                definePessoa('fisica');
            } else if($('#inlineRadio2').is(':checked')) {
                definePessoa('juridica');
            }
        });

    </script>
@endsection