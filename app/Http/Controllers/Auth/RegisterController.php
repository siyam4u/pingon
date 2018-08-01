<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        //$this->middleware('checkRole:administrator');


    }

    public function before()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'mimes:jpeg,jpg,png'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $createUserArray = array();
        $createUserArray['name'] = $data['name'];
        $createUserArray['email'] = $data['email'];
        $createUserArray['password'] = bcrypt($data['password']);
        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $userImageFolder = ('avatars').DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR;
            $image->move($userImageFolder, $image->getClientOriginalName());
            $createUserArray['image'] = $userImageFolder . $image->getClientOriginalName();
        }

        $user = User::create($createUserArray);
        $user->roles()->attach(2);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect()->back()->with('message', 'User Created Successfully');
    }

}
