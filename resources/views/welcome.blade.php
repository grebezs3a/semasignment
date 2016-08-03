@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Welcome to main page</h2>
        <p>Please select an option below.</p>

        <div class="row flex">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">New user</div>
                    <div class="panel-body">
                        Select this option if you don't have a profile <br>
                        <a class="btn btn-primary top-buffer text-center" href="{{ url('/register') }}"> <i class="fa fa-btn fa-user"></i>Register</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Existing user</div>
                    <div class="panel-body">
                        Select this option if you have a profile <br>
                        <a class="btn btn-primary top-buffer text-center" href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i>Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
