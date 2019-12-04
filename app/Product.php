<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // public $tableName = "products"; Sempre que a tabela não estiver no padrão com nome no plural
    // public $primaryKey = "id"; Sempre que a tabela não tiver primeiro o id
    // public $timestamps = false; Sempre que não tiver o timestamps na tabela

    public function user(){ // apenas 1 usuário. O laravel entende o plural como vários usuários e neste caso, é um produto para um usuário.
        return $this->belongsTo('App\User'); // Associação. Products pertence a Users. Relação de 1:N.
    }

}
