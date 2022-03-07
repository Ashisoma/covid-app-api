<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model{

    protected $table = 'permissions';

    protected $fillable = ['name', 'group_id'];

}
