<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the application dashboard.
     */
    public function index(): View
    {
        return view('Pages.index');
    }
}