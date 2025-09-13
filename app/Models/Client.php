<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'company_name',
        'audit_reference',
        'pic_name',
        'pic_phone',
        'certificate_no',
        'certificate_path',
        'issued_on',
        'effective_date',
        'expiry_date',
        'auditor_code',
        'auditor_name',
        'assigned_standard',
        'report_path',
        'company_profile_path',
        'ssm_path',
        'sop_path',
        'licenses_paths',
        'forms_evidence_paths',
        'iso_paths',
        'training_certificates',
    ];

    protected $casts = [
        'issued_on'             => 'date',
        'effective_date'        => 'date',
        'expiry_date'           => 'date',
        'licenses_paths'        => 'array',
        'forms_evidence_paths'  => 'array',
        'iso_paths'             => 'array',
        'training_certificates' => 'array', // {year: path}
    ];
}
