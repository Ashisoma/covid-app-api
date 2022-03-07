<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class PatientManagement extends Model{

    protected $table = 'patient_management';

    protected $fillable = [ "patient_id", "symptoms_onset_date", "admitted_to_hospital", "date_admitted", "facility_code", "isolated", "date_isolated", "admitted_to_icu", 
    "ventilated", "health_status", "outcome", "outcome_date", "symptoms_resolved", "date_resolved"
    ];

}
