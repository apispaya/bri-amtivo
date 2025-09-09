<?php

namespace App\Http\Controllers;

use App\Models\ClientCertification;

class DashboardController extends Controller
{
    // You can omit __construct() entirely because routes already use ->middleware('auth')

    public function index()
    {
        // Distinct companies (clients)
        $clientCount = ClientCertification::distinct('company_name')->count('company_name');

        // Total certifications (optional, if you show it)
        $certCount   = ClientCertification::count();

        return view('dashboard.dashboard', compact('clientCount', 'certCount'));
    }
}
