<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class ContactTracing extends Model
{
    protected $table = 'contact_tracing';

    protected $fillable = ['contact_id', 'county', 'subcounty', 'contactTraced', 'tracingDate', 'reported_by',
        'contactTested', 'testingDate', 'testOutcome'];
}
