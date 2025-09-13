<?php

namespace App\Http\Controllers;

use App\Models\ClientCertification;

class DashboardController extends Controller
{
    // You can omit __construct() entirely because routes already use ->middleware('auth')

    public function index()
    {
        $clientCount = \App\Models\Client::count();
        return view('dashboard.dashboard', compact('clientCount'));
    }
}
