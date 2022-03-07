<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class PatientTriage extends Model{
    protected $table = 'patient_triage';

    protected $fillable = ['temperature', 'weight', 'height', 'spo2', 'zscore', 'triage_time', 'patient_id', 'filled_by'];

}
