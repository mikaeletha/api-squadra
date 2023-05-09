<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\UF;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    public function index()
    {
        return Municipio::all();
    }

    public function show (Request $request)
    {
        $codigo_municipio = $request['codigoMunicipio'];
        $codigo_uf        = $request['codigoUF'];
        $nome             = $request['nome'];
        $status           = $request['status'];

        return Municipio::show($codigo_municipio, $codigo_uf, $nome, $status);
    }

    public function update (int $id, Request $request)
    {       
        if (Municipio::where('codigo_municipio', $id)->exists()) {

            $sigla = Municipio::where('codigo_uf', $request->codigoUF)->exists();
            $cidade = Municipio::where('nome', $request->nome)->exists();

            if ($sigla == true && $cidade == true) {
                return response()->json([
                    "message" => "Não foi possível alterar, pois já existe um registro de Município com o mesmo nome para a UF informada."
                ], 400);
            } else {
                $municipio = Municipio::find($id);
                $municipio->codigo_municipio = is_null($request->codigo_municipio) ? $municipio->codigo_municipio : $request->codigo_municipio;
                $municipio->codigo_uf        = is_null($request->codigoUF) ? $municipio->codigo_uf : $request->codigoUF;
                $municipio->nome             = is_null($request->nome) ? $municipio->nome : $request->nome;
                $municipio->status           = is_null($request->status) ? $municipio->status : $request->status;
                $municipio->save();
        
                return Municipio::all();
            }                       
        } else {
            return response()->json([
                "message" => "Não foi possível alterar o Muncípio."
            ], 503);
        }
    }

    public function store(Request $request)
    {
        $sigla = Municipio::where('codigo_uf', $request->codigoUF)->exists();
        $cidade = Municipio::where('nome', $request->nome)->exists();
        
        if ($sigla == true && $cidade == true) {
            return response()->json([
                "message" => "Não foi possível cadastrar, pois já existe um registro de Município com o mesmo nome para a UF informada."
            ], 400);
        }
        else {
            $municipio = new Municipio;
            $municipio->codigo_uf = $request->codigoUF;
            $municipio->nome      = $request->nome;
            $municipio->status    = $request->status;
            $municipio->save();            
            return response()->json([
                "message" => "Município cadastrado com sucesso."
            ], 201);
        }
        return response()->json([
            "message" => "Não foi possível cadastrar o município."
        ], 503);
    
    }
}
