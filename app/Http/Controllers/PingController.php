<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pingResult = array();
        return view('ping.index',['pingResult'=>$pingResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function ping(Request $request)
    {
        exec('ping -c 3 '.$request->ipAdd, $outcome, $status);
        $user = Auth::user();
        activity()
            ->causedBy($user->id)
            ->withProperties(['ip-Domain' => $request->ipAdd])
            ->log('ping');
        return view('ping.index',['pingResult'=>$outcome]);
    }
}