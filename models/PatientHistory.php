<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{

    protected $table = "patient_histories";

    protected $fillable = ['patient_id', 'date_taken', 'taken_by', 'travelled', 'places_travelled', 'contact_with_infected', 'contact_setting', 'vaccinated', 'first_dose', 'first_dose_date',
        'second_dose', 'second_dose_date'];

}
