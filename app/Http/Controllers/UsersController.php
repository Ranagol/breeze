<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [

            /**
             * This is how we do pagination in Inertia, when we only need the id and the name
             * columns.
             */
            'users' => User::paginate(10)->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name
            ])
        ]);



        // return Inertia::render('Users/Index', [
        //     'users' => User::query()
        //         ->when(Request::input('search'), function ($query, $search) {
        //             $query->where('name', 'like', "%{$search}%");
        //         })
        //         ->paginate(10)
        //         ->withQueryString()
        //         ->through(fn($user) => [
        //             'id' => $user->id,
        //             'name' => $user->name,
        //             'can' => [
        //                 'edit' => Auth::user()->can('edit', $user)
        //             ]
        //         ]),

        //     'filters' => Request::only(['search']),
        //     'can' => [
        //         'createUser' => Auth::user()->can('create', User::class)
        //     ]
        // ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users');
    }
}
