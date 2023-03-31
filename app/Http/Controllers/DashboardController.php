<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $messagesCount = 1;

        return view('dashboard')
            ->with('messagesCount', $messagesCount);
    }
}
