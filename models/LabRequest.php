<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class LabRequest extends Model
{

    protected $table = 'lab_requests';

    protected $fillable = [
        'patient_id', 'specimen_collected', 'reason_not_collected', 'test_type', 'specimen_type', 'date_collected',
        'date_sent_to_lab', 'date_received_in_lab', 'confirming_lab', 'assay_used', 'lab_result',
        'sequencing_done', 'lab_confirmation_date', 'investigator', 'active'
    ];
}
