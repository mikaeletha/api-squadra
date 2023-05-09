<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pessoa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nome',
        'sobrenome',
        'idade',
        'login',
        'senha',
        'status',
    ];
    protected $table = 'tb_pessoa';
    protected $primaryKey = 'codigo_pessoa';

    public function index ()
    {
        $table = DB::table('tb_pessoa')
            ->join('tb_endereco', 'tb_pessoa.codigo_pessoa', '=', 'tb_endereco.codigo_pessoa')
            ->join('tb_bairro', 'tb_endereco.codigo_bairro', '=', 'tb_bairro.codigo_bairro')
            ->join('tb_municipio', 'tb_bairro.codigo_municipio', '=', 'tb_municipio.codigo_municipio')
            ->join('tb_uf', 'tb_municipio.codigo_uf', '=', 'tb_uf.codigo_uf')
            ->get();

            return $table;

    }

     // OBS a busca é case sensitive, então isso interfere no resultado do show
     public function show ($codigo_pessoa, $nome, $sobrenome, $idade, $login, $senha, $status)
     {
        // GET /pessoa?status=2&codigoPessoa=12&login=diegomoura
        if ($codigo_pessoa != null && $nome == null && $sobrenome == null && $idade == null && $login != null && $senha == null && $status != null)
        {
           return Pessoa::where([            
                'codigo_pessoa' => $codigo_pessoa,
                'login' => $login,
                'status' => $status
            ])->get();
        }
        // GET /pessoa?status=2
        else if ($codigo_pessoa == null && $nome == null && $sobrenome == null && $idade == null && $login == null && $senha == null && $status != null)
        {
            return Pessoa::where([
                'status' => $status
            ])->get();            
        }
        // GET /pessoa?codigoPessoa=109&status=1
        else if ($codigo_pessoa != null && $nome == null && $sobrenome == null && $idade == null && $login == null && $senha == null && $status != null)
        {
            return Pessoa::where([
                'codigo_pessoa' => $codigo_pessoa,
                'status' => $status
            ])->get();            
        }
        // GET /pessoa?login=jose.maria
        else if ($codigo_pessoa == null && $nome == null && $sobrenome == null && $idade == null && $login != null && $senha == null && $status == null)
        {
            return Pessoa::where([
                'login' => $login,
            ])->get();            
        }
    }
}
