<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        $adminRole = $user->hasRole('administrator');
        if ($adminRole) {
            $user = request('user');
        }
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255|min:5',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $userImageFolder = ('avatars').DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR;
            $image->move($userImageFolder, $image->getClientOriginalName());
            $user->image = $userImageFolder . $image->getClientOriginalName();
        }
        $user->name = request('name');
        $user->save();
        return redirect()->back()->with('message', 'Updated Successfully');

    }
}
