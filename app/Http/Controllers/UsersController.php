<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UsersController extends Controller
{
  public function index(Request $request) {
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
       *
       * Also, this way if there is a page refresh, the backend will remember the search term,
       * an will send it back to Vue. This way the search term will not be lost.
       *
       * Request::only(['search'] --- use only the 'search' param
       * So, again, here the server is sending the browser the filters back, and this will
       * be the initial search value on the frontend.
       */
      'filters' => Request::only(['search'])
    ]);
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

    /**
     * If this would have been a real SPA app, we would send back just a JSON response. But, this
     * is Inertia, and Inertia is more similar to Laravel + Blade stup. That is why we have this
     * redirect.
     */
    return redirect('/users');
  }


  
}
