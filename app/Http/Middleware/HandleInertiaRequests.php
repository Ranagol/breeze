<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
      return [
        ...parent::share($request),

        /**
         * Check if the user is logged in. If so, get and return his name. If not, return null.
         */
        'auth' => Auth::user() ? [
          'user' => [
            'username' => Auth::user()->name
          ]
        ] : null,



        'ziggy' => fn () => [
          ...(new Ziggy)->toArray(),
          'location' => $request->url(),
        ],
        'andorData' => [
          'egy' => '1',
          'ketto' => '2'
        ]

      ];
    }
}
