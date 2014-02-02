<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(
    function ($request) {
        //
    }
);


App::after(
    function ($request, $response) {
        //
    }
);


Route::filter(
    'auth',
    function () {
        if (Auth::guest()) {
            return Redirect::guest('/');
        }
    }
);


Route::filter(
    'auth.basic',
    function () {
        return Auth::basic();
    }
);

Route::filter(
    'guest',
    function () {
        if (Auth::check()) {
            return Redirect::to('/login');
        } //bla
    }
);

Route::filter(
    'csrf',
    function () {
        if (Session::token() != Input::get('_token')) {
            throw new Illuminate\Session\TokenMismatchException;
        }
    }
);

Route::filter(
    'access',
    function () {
        if (Auth::check() && Auth::user()->power < 2) {
            return Redirect::to('/');
        }
        if (Auth::guest()){
            return Redirect::to('/');
        }
    }
);
