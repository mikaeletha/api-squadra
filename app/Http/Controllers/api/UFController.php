<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UF;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApiRequest;


class UFController extends Controller
{
    public function index() 
    {
        return UF::all();
    }

    public function show (Request $request)
    {
        $codigo_uf = $request['codigoUF'];
        $sigla     = $request['sigla'];
        $nome      = $request['nome'];
        $status    = $request['status'];

        return UF::show($codigo_uf, $sigla, $nome, $status);
    }

    public function update (int $id, ApiRequest $request) 
    {       
        if (UF::where('codigo_uf', $id)->exists()) {
            $uf = UF::find($id);
            $uf->sigla  = is_null($request->sigla) ? $uf->sigla : $request->sigla;
            $uf->nome   = is_null($request->nome) ? $uf->nome : $request->nome;
            $uf->nome   = is_null($request->nome) ? $uf->nome : $request->nome;

            $sigla = UF::where('sigla', $request->sigla)->exists();
            if ($sigla == true) {
                return response()->json([
                    "message" => "Não foi possível alterar, pois já existe um registro de UF com a mesma sigla cadastrada."
                ], 400);
            } else {
                $uf->save();
                return UF::all();
            }
        } else {
            return response()->json([
                "message" => "Não foi possível alterar a UF."
            ], 503);
            
        }
    }

    public function store(ApiRequest $request)
    {
        $sigla = UF::where('sigla', $request->sigla)->exists();
            if ($sigla == true) {
                return response()->json([
                    "message" => "Não foi possível cadastrar, pois já existe um registro de UF com a mesma sigla."
                ], 400);
        } else {
            $uf = UF::create($request->all());
            return response()->json([
                "message" => "UF cadastrada com sucesso."], 201);
        }

        return response()->json([
            "mensagem" => "Não foi possível cadastrar a UF."],503);
    }
}
