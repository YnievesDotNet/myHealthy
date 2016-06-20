<?php

namespace App\Http\Controllers;

use Log;

class PagesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * WelcomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        Log::info('Welcome hit');
        return view('welcome');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function about()
    {
        Log::info('About hit');
        return view('welcome');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function contact()
    {
        Log::info('Contact hit');
        return view('welcome');
    }
}
