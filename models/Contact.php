<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model{
    protected $table = "contacts";

    protected $fillable = ["firstName", "middleName", "surname", "phoneNumber", "active", "patient_id"];

}
