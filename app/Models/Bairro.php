<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bairro extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'codigo_bairro',
        'codigo_municipio',
        'nome',
        'status',
    ];
    protected $table = 'tb_bairro';
    protected $primaryKey = 'codigo_bairro';

    // OBS a busca é case sensitive, então isso interfere no resultado do show
    public function show ($codigo_bairro, $codigo_municipio, $nome, $status){
        // GET /bairro?codigoBairro=15&codigoMunicipio=10&nome=Vila dos Ipês
        if ($codigo_bairro != null && $codigo_municipio != null && $nome != null && $status == null)
        {
           return Bairro::where([
                'codigo_bairro' => $codigo_bairro,
                'codigo_municipio' => $codigo_municipio,                
                'nome' => $nome
            ])->get();
        }
        // GET /bairro?codigoBairro=12
        else if ($codigo_bairro != null && $codigo_municipio == null && $nome == null && $status == null)
        {
            return Bairro::where([
                'codigo_bairro' => $codigo_bairro,
            ])->get();            
        }
        // GET /bairro?codigoMunicipio=10&nome=Vila das Pedras
        else if ($codigo_bairro == null && $codigo_municipio != null && $nome != null && $status == null)
        {
            return Bairro::where([
                'codigo_municipio' => $codigo_municipio,
                'nome' => $nome,
            ])->get();            
        }
        // GET /bairro?nome=Vila das Pedras
        else if ($codigo_bairro == null && $codigo_municipio == null && $nome != null && $status == null)
        {
            return Bairro::where([
                'nome' => $nome,
            ])->get();            
        }
        // GET /bairro?status=2
        else if ($codigo_bairro == null && $codigo_municipio == null && $nome == null && $status != null)
        {
            return Bairro::where([
                'status' => $status,
            ])->get();
        }
    }
}
