<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class SettingsController extends Controller
{
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
