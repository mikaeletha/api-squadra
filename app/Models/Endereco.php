<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Endereco extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'codigo_pessoa',
        'codigo_bairro',
        'nome_rua',
        'numero',
        'complemento',
        'cep',
    ];
    protected $table = 'tb_endereco';
    protected $primaryKey = 'codigo_endereco';
}
