@extends('layout.base')
@section('content')
<div class="row">
    <div class="col-md">
        <form method="POST" action="{{ route('cliente.store') }}">
            @csrf
            <div class="form-group">
                <label>UF <span class="text-danger">*</span></label>
                <select name="uf" class="form-control" id="uf" required>
                    <option value="" selected disabled>Estado:</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nome Fantasia: <span class="text-danger">*</span></label>
                <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" placeholder="Nome Fantasia" required>
            </div>
            <div class="form-group">
                <label>CNPJ <span class="text-danger">*</span></label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" required>
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
    </script>
@endsection