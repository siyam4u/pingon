<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NslookupController extends Controller
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
        return view('nslookup.index',['pingResult'=>$pingResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function nslookup(Request $request)
    {
        $ipAdd = gethostbyname($request->ipAdd);
        exec('nslookup '.$request->ipAdd, $outcome, $status);
        $user = Auth::user();
        activity()
            ->causedBy($user->id)
            ->withProperties(['ip-Domain' => $request->ipAdd])
            ->log('nslookup');
        return view('nslookup.index',['pingResult'=>$outcome]);
    }
}