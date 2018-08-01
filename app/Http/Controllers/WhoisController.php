<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class WhoisController extends Controller
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
        return view('whois.index',['pingResult'=>$pingResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function whois(Request $request)
    {
        exec('whois '.$request->ipAdd, $outcome, $status);
        $user = Auth::user();
        activity()
            ->causedBy($user->id)
            ->withProperties(['ip-Domain' => $request->ipAdd])
            ->log('whois');

        return view('whois.index',['pingResult'=>$outcome]);
    }
}