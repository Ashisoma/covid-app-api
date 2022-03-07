<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class CovidVaccine extends Model{
    protected $table = 'covid_vaccines';

    protected $fillable = ['name'];
}
