<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;



class RegisterController extends Controller
{
    function index(){
        //passing countries array to view
        $countries = Country::all();
        return view('auth.register', compact('countries'));
    }

    function register(Request $request){
       // validating user input
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6'
        ]);

        //activation link code
        $confirmation_code = str_random(30);

        //url to selected country
        $url = 'https://www.google.lv/maps/place/' .$request->country;

        //creating user in database
        User::create([
            'name' => $request->name,
            'country' => $request->country,
            'email' => $request->email,
            'password' => $request->password,
            'confirmation_code' => $confirmation_code
        ]);

        //sending email vith activation link
        Mail::send('verify', ['confirmation_code'=>$confirmation_code], function($message) {
            $message->to( Input::get('email'), Input::get('name'))
                ->subject('Verify your email address');
        });
        return redirect($url);
    }

    public function confirm($confirmation_code){

        if(!$confirmation_code){
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user){
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/user/activation');
    }
}
