<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bairro;
use Illuminate\Support\Facades\DB;

class BairroController extends Controller
{
    public function index()
    {
        return Bairro::all();
    }

    public function show(Request $request)
    {
        $codigo_bairro    = $request['codigoBairro'];
        $codigo_municipio = $request['codigoMunicipio'];
        $nome             = $request['nome'];
        $status           = $request['status'];

        return Bairro::show($codigo_bairro, $codigo_municipio, $nome, $status);
    }

    public function update (int $id, Request $request)
    {       
        if (Bairro::where('codigo_bairro', $id)->exists()) 
        {
            $bairro = Bairro::where('codigo_municipio', $request->codigoMunicipio)->exists();
            $cidade = Bairro::where('nome', $request->nome)->exists();

            if ($bairro == true && $cidade == true)
            {
                return response()->json([
                    "message" => "Não foi possível alterar, pois já existe um registro de Bairro com o mesmo nome para o Município informado."
                ], 400);
            } 
            else {
            $bairro = Bairro::find($id);
            $bairro->codigo_municipio     = is_null($request->codigoMunicipio) ? $bairro->codigo_municipio : $request->codigoMunicipio;
            $bairro->nome                 = is_null($request->nome) ? $bairro->nome : $request->nome;
            $bairro->status               = is_null($request->status) ? $bairro->status : $request->status;
            $bairro->save();

            return Bairro::all();
            } 
        }
        else {
            return response()->json([
                "message" => "Não foi possível alterar o Bairro."
            ], 503);            
        }
    }

    public function store(Request $request)
    {
        $bairro = Bairro::where('codigo_municipio', $request->codigoMunicipio)->exists();
        $cidade = Bairro::where('nome', $request->nome)->exists();

        if ($bairro == true && $cidade == true)
        {
            return response()->json([
                "message" => "Não foi possível cadastrar, pois já existe um registro de Bairro com o mesmo nome para o Município informado."
            ], 400);
        }
        else
        {
            $bairro = new Bairro;
            $bairro->codigo_municipio = $request->codigoMunicipio;
            $bairro->nome          = $request->nome;
            $bairro->status        = $request->status;
            $bairro->save();

            return response()->json([
                "message" => "Bairro cadastrado com sucesso."
            ], 201);
        }

        return response()->json([
            "message" => "Não foi possível cadastrar o bairro."
        ], 503);
    
    }
}
