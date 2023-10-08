<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{ 
  /**
   * Display the Login page.
   */
  public function create()
  {
    return Inertia::render('Auth/Login');
  }

  /**
   * Logs in the user.
   */
  public function store(Request $request)
  {
    //Validation
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    /**
     * The attempt method is normally used to handle authentication attempts from your application's 
     * "login" form. If authentication is successful, you should regenerate the user's session.
     * The attempt method accepts an array of key / value pairs as its first argument. The values 
     * in the array will be used to find the user in your database table. So, in the example above, 
     * the user will be retrieved by the value of the email column. If the user is found, the hashed 
     * password stored in the database will be compared with the password value passed to the method 
     * via the array. You should not hash the incoming request's password value, since the framework 
     * will automatically hash the value before comparing it to the hashed password in the database. 
     * An authenticated session will be started for the user if the two hashed passwords match.
     * The attempt method will return true if authentication was successful. Otherwise, false will 
     * be returned.
     */
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      /**
       * Example explanation for intended(): A user wants to go to /settings page, but he is not
       * logged in. Because of this, he will be redirected to the /login page. Once he logs in in 
       * the login page, the user will be automatically redirected to the initially INTENDED page, 
       * the /settings page.
       * The intended method provided by Laravel's redirector will redirect the user to the URL they 
       * were attempting to access before being intercepted by the authentication middleware.
       */
      return redirect()->intended();
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }
  /**
   * LOGOUT
   */
  public function destroy()
  {
    Auth::logout();

    return redirect()->route('login');
  }
}
