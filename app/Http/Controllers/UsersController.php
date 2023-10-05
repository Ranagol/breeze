<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [

            /**
             * This is how we do pagination in Inertia, when we only need the id and the name
             * columns.
             * ::query() simply means here, that we started a query. Helps the -> chaining.
             */
            'users' => User::query()
                    //SEARCH FILTER BY NAME
                    ->when(Request::input('search'), function($query, $search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    //PAGINATION
                    ->paginate(10)
                    //Paginate the search result, but include the query string too into pagination data links for page 1,2,3,4... And the url will now include this too: http://127.0.0.1:8000/users?search=a&page=2 if we click on the searc results, page 2
                    ->withQueryString()
                    //ONLY ID AND NAME ARE NEEDED
                    ->through(fn($user) => [
                        'id' => $user->id,
                        'name' => $user->name
                    ]),
            /**
             * 'filters' means: the already existing user name search term filters. Meaning that
             * what if a user receves a link like this: http://127.0.0.1:8000/users?search=aida,
             * and clicks on it? We will take this filter out of the request and send it back
             * to Vue.
             * Request::only(['search'] --- use only the 'search' param
             * So, again, here the server is sending the browser the filters back, and this will
             * be the initial search value on the frontend.
             */
            'filters' => Request::only(['search'])
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
