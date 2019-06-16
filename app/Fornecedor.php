<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'client_id', 'nome', 'cnpj', 'rg', 'nascimento'
    ];

}
