<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class NumberClient extends Model{

    protected $table = 'number_clients';

    protected $fillable = ["name", "prefix", "separator", "minLength", 'lastIndex'];

}
