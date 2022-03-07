<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class PatientScreening extends Model {

    protected $table = 'patient_screening';

    protected $fillable = [
        'patient_id',
        'screened_by',
        'date_screened',
        'fever_history',
        'chills',
        'general_weakness',
        'cough',
        'sore_throat',
        'runny_nose',
        'weight_loss',
        'night_sweats',
        'loss_of_taste',
        'loss_of_smell',
        'breathing_difficulty',
        'diarrhoea',
        'headache',
        'irritability',
        'confusion',
        'nausea',
        'vomiting',
        'abdominal_pain',
        'chest_pain',
        'joint_pain',
        'muscle_pain',
    ];
}
