<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Municipio extends Model
{
    use HasFactory;

    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'codigo_municipio',
        'codigo_uf',
        'nome',
        'status',
    ];
    protected $table = 'tb_municipio';
    protected $primaryKey = 'codigo_municipio';

    // OBS a busca é case sensitive, então isso interfere no resultado do show
    public function show ($codigo_municipio, $codigo_uf, $nome, $status){
        // GET /municipio?codigoUF=10&codigoMunicipio=105&nome=Florianópolis
        if ($codigo_municipio != null && $codigo_uf != null && $nome != null && $status == null)
        {
           return Municipio::where([
                'codigo_municipio' => $codigo_municipio,
                'codigo_uf' => $codigo_uf,
                'nome' => $nome
            ])->get();
        }
        // GET /municipio?codigoMunicipio=106
        else if ($codigo_municipio != null && $codigo_uf == null && $nome == null && $status == null)
        {
            return Municipio::where([
                'codigo_municipio' => $codigo_municipio,
            ])->get();            
        }
        // GET /municipio?codigoMunicipio=109&nome=Goiânia
        else if ($codigo_municipio != null && $codigo_uf == null && $nome != null && $status == null)
        {
            return Municipio::where([
                'codigo_municipio' => $codigo_municipio,
                'nome' => $nome,
            ])->get();            
        }
        // GET /municipio?nome=Cuiabá
        else if ($codigo_municipio == null && $codigo_uf == null && $nome != null && $status == null)
        {
            return Municipio::where([
                'nome' => $nome,
            ])->get();            
        }
        // GET /municipio?status=2
        else if ($codigo_municipio == null && $codigo_uf == null && $nome == null && $status != null)
        {
            return Municipio::where([
                'status' => $status,
            ])->get();
        }
        else {
            return response()->json([
                "message" => "Não foi possível pesquisar o Município."
            ], 503);
        }
    }
}
