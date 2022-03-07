<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model {

    protected $table = 'facilities';

    protected $fillable = ['mflCode', 'name', 'county', 'subCounty', 'project'];
}
