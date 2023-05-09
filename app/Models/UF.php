<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UF extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'codigo_uf',
        'sigla',
        'nome',
        'status',
    ];
    protected $table = 'tb_uf';
    protected $primaryKey = 'codigo_uf';

    public function index() {
        // dd('aqui');
        // DB::select * $table;
        // return UF::all();

        
        // self::addGlobalScope('ordered', function (Builder $queryBuilder) {
        //     $queryBuilder->orderBy('SIGLA');
        // });
    }

    // OBS a busca é case sensitive, então isso interfere no resultado do show
    public function show ($codigo_uf, $sigla, $nome, $status){
        // GET /uf?codigoUF=15&nome=GOIÁS&sigla=GO
        if ($codigo_uf !=null && $sigla !=null && $nome !=null)
        {
           return UF::where([
                'codigo_uf' => $codigo_uf,
                'sigla' => $sigla,
                'nome' => $nome,
            ])->get();
        }
        // GET /uf?sigla=GO
        else if ($codigo_uf == null && $sigla != null && $nome  == null)
        {
            return UF::where([
                'sigla' => $sigla,
            ])->get();            
        }
        // GET /uf?codigoUF=12&nome=São Paulo
        else if($codigo_uf != null && $sigla == null && $nome != null)
        {
            return UF::where([
                'codigo_uf' => $codigo_uf,
                'nome' => $nome,
            ])->get();            
        }
        // GET /uf?nome=Pará
        else if($codigo_uf == null && $sigla == null && $nome != null)
        {
            return UF::where([
                'nome' => $nome,
            ])->get();            
        } else {
            return response()->json([
                "message" => "Não foi possível pesquisar a UF."
            ], 503);
        }
    }
}
