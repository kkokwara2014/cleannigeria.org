<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernanceController extends Controller
{
    public function governance()
    {
        return view('frontend.governance.governance');
    }
}
