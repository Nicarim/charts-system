<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//home page
Route::get('/', array("as" => "home", function(){
	return View::make('layouts/home');
}));
//charts
Route::get('/charts/add', function(){
    return View::make('layouts/charts-add');
})->before('access');
Route::post('/charts/add', 'ChartsController@Create');
Route::get("/charts", 'ChartsController@View');
Route::get("/charts/view/{id}/{mode?}", 'ChartsController@ViewVoting')->before('auth');
//User access
Route::get('/users/add', function(){
    return View::make('layouts/manage-adduser');
})->before('access');
Route::post('/users/add', 'ChartsController@AddUser')->before('access');
Route::get('/users', 'ChartsController@ListUsers')->before('access');
Route::get('/users/delete/{id}/{type}', 'ChartsController@DeleteOrRestoreUser')->before('access');
Route::get('/users/pass', function(){
    return View::make('layouts/manage-password');
})->before('auth');
Route::post('/users/pass', 'ChartsController@ChangePass')->before('auth');
//Authentication
Route::get("/login", array ("as" => "login", function(){
    return View::make('layouts/manage-login');
}))->before('guest');
Route::post("/login", 'ChartsController@Login')->before('guest');
Route::get("/logout", function(){
    Auth::logout();
    return Redirect::route("home");
});