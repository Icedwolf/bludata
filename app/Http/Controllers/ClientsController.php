<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Telefone;
use App\Fornecedor;

class ClientsController extends Controller {

    public function __construct()
    {
        //modularização do path das views
        $this->view = 'clientes.';
        $this->route = 'empresa.';
    }

    public function index()
    {
        $clientes = Client::all();
        return view($this->view . 'index', compact('clientes'));
    }

    public function create()
    {
        return view($this->view . 'cadastro');        
    }

    public function store(Request $request)
    {
        $request->validate([
            'uf'=>'required',
            'nome_fantasia'=>'required',
            'cnpj'=>'required|unique:clients'
        ]);
        
        $inputs = $request->all();

        $client = new Client([
            'uf' => $inputs['uf'],
            'nome_fantasia' => $inputs['nome_fantasia'],
            'cnpj' => $inputs['cnpj'],
        ]);
        $id = $client->save();
        return redirect()->route($this->route . 'edit', $id)->with('success', 'Registro Criado com Sucesso');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view($this->view . 'cadastro', compact('client'));   
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'uf'=>'required',
            'nome_fantasia'=>'required',
            'cnpj'=>'required|unique:clients,cnpj,' . $id
        ]);

        $inputs = $request->all();
        $client = Client::find($id);
        $client->update($inputs);
        return redirect()->route($this->route . 'edit', $id)->with('success', 'Registro atualizado com sucesso');
    }

    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route($this->route . 'index');
    }

    public function fornecedores($id){
        $fornecedores = Fornecedor::Where('client_id',$id)->get();
        $client = Client::find($id);
        return view('fornecedores.index', compact('fornecedores','client'));
    }

    public function show()
    {

    }
}
