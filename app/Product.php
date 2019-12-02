<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // public $tableName = "products"; Sempre que a tabela não estiver no padrão com nome no plural
    // public $primaryKey = "id"; Sempre que a tabela não tiver primeiro o id
    // public $timestamps = false; Sempre que não tiver o timestamps na tabela

    public function users(){
        return $this->belongsTo('App\User'); // Associação. Products pertence a Users. Relação de 1:N.
    }

}
