<?php


namespace models;
use Illuminate\Database\Eloquent\Model;



class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = ['firstName',	'secondName', 'surname', 'facility', 'nationalID', 'guardianID', 'guardianName',
        'phone', 'citizenship', 'gender', 'department', 'occupation', 'maritalStatus', 'educationLevel', 'dob', 'alive',
        'caseLocation', 'investigatingFacility', 'county', 'subCounty', 'nokName', 'nokPhone', "landmark"];
}
