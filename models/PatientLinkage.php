<?php


namespace models;


class PatientLinkage extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'patient_linkages';

    protected $fillable = ['patient_id', 'weight', 'height', 'linkage_date', 'linkage_dept', 'linkage_number', 'dot_manager', 'tb_type', 'eptb_subtype',
        'patient_type', 'culture', 'regiment', 'hiv_status'];

}

