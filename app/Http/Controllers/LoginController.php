<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{

    function index(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        $userdata = array(
            'email'     => Input::get('email'),
            'password'  => Input::get('password'),
            'confirmed' => 1
        );

        if (Auth::attempt($userdata)) {
            return view('logged_in');
        } else {
            return view('login_error');

        }
    }
}
