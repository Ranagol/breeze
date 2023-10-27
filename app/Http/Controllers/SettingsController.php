<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class SettingsController extends Controller
{   
    /**
     * //For simplicity we create here a client and send it to the Vue component through Inertia
     */
    public function index()
    {
        $client = [
            'name' => 'Apple',
            'email' => 'steve@jobs.com',
        ];

        return Inertia::render('Settings', [
            'client' => $client
        ]);
    }
}
