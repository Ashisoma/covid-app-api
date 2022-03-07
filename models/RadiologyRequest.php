<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class RadiologyRequest extends Model{

    protected $table = 'radiology_requests';

    protected $fillable = ['date_requested', 'patient_id', 'date_done', 'test_type', 'results', 'comments', 'files',
        'submitted_by'];

}
