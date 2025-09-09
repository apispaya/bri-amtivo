<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientCertification extends Model
{
    protected $fillable = [
        'company_name',
        'pic_name',
        'pic_phone',
        'audit_reference',
        'certificate_no',
        'certificate_path',
        'issued_on',
        'effective_date',
        'expiry_date',
    ];

    protected $casts = [
        'issued_on'      => 'date',
        'effective_date' => 'date',
        'expiry_date'    => 'date',
    ];
}
