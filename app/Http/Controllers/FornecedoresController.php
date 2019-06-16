<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use App\Client;
use App\Telefone;
use Illuminate\Support\Facades\Validator;

class FornecedoresController extends Controller
{
    public function __construct()
    {
        //modularização do path das views
        $this->view  = 'fornecedores.';
        $this->route = 'fornecedores.';
    }
    public function index($id)
    {
        $client = Client::find($id);
        $fornecedores = Fornecedor::where('client_id',$id)->get();
        return view($this->view . 'index', compact('fornecedores','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Client::all();
        return view($this->view . 'cadastro', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'client_id'=>'required',
            'nome'=>'required',
        ];
        $custom[] = '';
        if($request->pessoa == 'fisica'){
            $empresa = Client::find($request->client_id);
            if($empresa->uf == 'PR'){
                $rules['nascimento']  = 'required|valid_birth_date';
                $custom['nascimento.valid_birth_date'] = 'Você precisa ser maior de 18 anos';
            }else {
                $rules['nascimento'] = 'required';
            }
            $rules['cpf'] = 'required';
            $rules['rg']  = 'required';
        } else {
                $rules['cnpj'] = 'required';
        }
        $validator = Validator::make($request->all(),$rules,$custom);
        if ($validator->fails()) {
            return redirect()
                    ->route($this->route . 'create')
                    ->withErrors($validator)
                    ->withInput();
        }
        $inputs = $request->all();
        if($inputs['cpf']){
            $inputs['cnpj'] = $inputs['cpf'];
        }
        $fornecedor = Fornecedor::create( $inputs );
        if($inputs['telefone'][0] != null) {
            foreach($inputs['telefone'] as $telefone){
                Telefone::create(['fonecedor_id' => $fornecedor->id, 'telefone' => $telefone]);
            } 
        }
        return redirect()->route($this->route . 'edit', $fornecedor->id)->with('success', 'Registro Criado com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fornecedor = Fornecedor::find($id);
        $empresas = Client::all();
        $telefones = Telefone::Where('fornecedor_id')->get();
        return view($this->view . 'cadastro', compact('fornecedor','empresas', 'telefones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'client_id'=>'required',
            'nome'=>'required',
        ];
        $custom[] = '';
        if($request->pessoa == 'fisica'){
            $empresa = Client::find($request->client_id);
            if($empresa->uf == 'PR'){
                $rules['nascimento']  = 'required|valid_birth_date';
                $custom['nascimento.valid_birth_date'] = 'Você precisa ser maior de 18 anos';
            }else {
                $rules['nascimento'] = 'required';
            }
            $rules['cpf'] = 'required';
            $rules['rg']  = 'required';
        } else {
                $rules['cnpj'] = 'required';
        }
        $validator = Validator::make($request->all(),$rules,$custom);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $inputs = $request->all();
        if($inputs['cpf']){
            $inputs['cnpj'] = $inputs['cpf'];
        }
        $fornecedor = Fornecedor::find($id);
        $fornecedor->update( $inputs );
        foreach($inputs['telefone'] as $telefone){
            if($telefone != null){
                Telefone::create(['fonecedor_id' => $fornecedor->id, 'telefone' => $telefone]);
            }
        }   
        return redirect()->route($this->route . 'edit', $fornecedor->id)->with('success', 'Registro atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fornecedor::find($id)->delete();
        return back();
    }

    public function deletaTelefone($id){
        Telefone::destroy($id);
        return back();
    }
}
