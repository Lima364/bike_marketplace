<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // em caso de se usar um nome de tabela diferente
    // protected $table = 'nome do arquivo';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
