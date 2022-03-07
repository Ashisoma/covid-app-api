<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model{
    protected $table = 'user_categories';

    protected $fillable = ['name', 'description', 'permissions', 'access_level'];
    
}
