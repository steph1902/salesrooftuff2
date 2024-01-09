<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesDashboardController extends Controller
{
    //
    public function dashboard()
    {
        // Pengecekan peran
        $this->authorize('view-dashboard', 'sales');

        // Logika untuk dashboard sales
        return view('sales.dashboard');
    }
}
