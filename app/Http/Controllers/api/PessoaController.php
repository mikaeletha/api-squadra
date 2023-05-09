<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    public function index()
    {
        // return Pessoa::all();
        return Pessoa::index();
    }

    public function show(Request $request)
    {
        $codigo_pessoa = $request['codigoPessoa'];
        $nome = $request['nome'];
        $sobrenome = $request['sobrenome'];
        $idade = $request['idade'];
        $login = $request['login'];
        $senha = $request['senha'];
        $status = $request['status'];

        
        return Pessoa::show($codigo_pessoa, $nome, $sobrenome, $idade, $login, $senha, $status);    
    }

    public function update (int $id, Request $request)
    {       
        if (Pessoa::where('codigo_pessoa', $id)->exists()) 
        {
            $pessoa = Pessoa::find($id);
            $pessoa->nome = is_null($request->nome) ? $pessoa->nome : $request->nome;
            $pessoa->sobrenome = is_null($request->sobrenome) ? $pessoa->sobrenome : $request->sobrenome;
            $pessoa->idade = is_null($request->idade) ? $pessoa->idade : $request->idade;
            $pessoa->login = is_null($request->login) ? $pessoa->login : $request->login;
            $pessoa->senha = is_null($request->senha) ? $pessoa->senha : $request->senha;
            $pessoa->status = is_null($request->status) ? $pessoa->status : $request->status;
            $pessoa->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
            
        }
    }

    public function store(Request $request)
    { 
        $pessoa = new Pessoa;
        $pessoa->nome      = $request->nome;
        $pessoa->sobrenome = $request->sobrenome;
        $pessoa->idade     = $request->idade;
        $pessoa->login     = $request->login;
        $pessoa->senha     = $request->senha;
        $pessoa->status    = $request->status;
        $pessoa->save();

        foreach ($request->enderecos as $enderecos){
            $endereco = new Endereco;
            $endereco->codigo_pessoa = $pessoa->codigo_pessoa;
            $endereco->codigo_bairro = $enderecos['codigoBairro'];
            $endereco->nome_rua = $enderecos['nomeRua'];
            $endereco->numero = $enderecos['numero'];
            $endereco->complemento = $enderecos['complemento'];
            $endereco->cep = $enderecos['cep'];
            $endereco->save();
        }    
    }
}
