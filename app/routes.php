<?php
// public view
Route::get('/', array("as" => "home", function(){
	return View::make('layouts/home');
}));
Route::get("/charts", 'ChartsController@View');

Route::group(array('before' => 'access'), function(){ //admin level access
    Route::get('/users/add', function(){
        return View::make('layouts/manage-adduser');
    });
    Route::post('/users/add', 'ChartsController@AddUser');
    Route::get('/users', 'ChartsController@ListUsers');
    Route::get('/users/delete/{id}/{type}', 'ChartsController@DeleteOrRestoreUser');
    Route::get('/charts/add', function(){
        return View::make('layouts/charts-add');
    });
    Route::post('/charts/add', 'ChartsController@Create');
});
Route::group(array('before' => 'guest'), function(){ //only guests
    Route::get("/login", array ("as" => "login", function(){
        return View::make('layouts/manage-login');
    }));
    Route::post("/login", 'ChartsController@Login');
});

Route::group(array('before' => 'auth'), function(){ //logged in users
    Route::get('/users/pass', function(){
        return View::make('layouts/manage-password');
    });
    Route::post('/users/pass', 'ChartsController@ChangePass');
    Route::get("/charts/view/{id}/{mode?}", 'ChartsController@ViewVoting');
    Route::get("/logout", function(){
        Auth::logout();
        return Redirect::route("home");
    });
});