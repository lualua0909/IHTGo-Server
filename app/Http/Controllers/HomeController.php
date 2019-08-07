<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('activated');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function activated(Request $request, UserRepositoryContract $userRepositoryContract)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $user = $userRepositoryContract->find($request->user);
        $user->activated = true;
        $user->save();
    }
}
