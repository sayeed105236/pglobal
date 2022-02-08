<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['string', 'min:11', 'max:14', 'unique:users'],
            'request_role' => [],
            'address' => [],
            'referred_by' => [],
            'gender' => [],
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
        
        if(!isset($data['phone'])){$phone = NULL;}
        else{$phone = $data['phone'];}


        if(!isset($data['request_role'])){$request_role = "user";}
        else{$request_role = $data['request_role'];}

        if(!isset($data['address'])){$address = NULL;}
        else{$address = $data['address'];}
        
        if(!isset($data['referred_by'])){$referred_by = "#AFF001";}
        else{$referred_by = $data['referred_by'];}

        
        if(!isset($data['gender'])){$gender = NULL;}
        else{$gender = $data['gender'];}


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $phone,
            'request_role' => $request_role,
            'address' => $address,
            'referred_by' => $referred_by,
            'gender' => $gender,
        ]);
    }
}
