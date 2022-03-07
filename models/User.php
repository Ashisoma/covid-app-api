<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $fillable = ['names', 'gender', 'email', 'phone', 'project', 'facility', 'password', 'category',
        'last_login', 'active'];

    protected $hidden = ['password'];
    
}
