<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    //
    public function dashboard()
    {
        // Pengecekan peran
        $this->authorize('view-dashboard', 'owner');

        // Logika untuk dashboard owner
        return view('owner.dashboard');
    }
}
