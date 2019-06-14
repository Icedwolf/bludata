<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'uf', 'nome_fantasia', 'cnpj'
    ];
}
