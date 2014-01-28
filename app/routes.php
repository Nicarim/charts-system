<?php
// public view
Route::get(
    '/',
    array(
        "as" => "home",
        function () {
            return View::make('home');
        }
    )
);
Route::get("/charts", 'ChartsController@View');

Route::group(
    array('before' => 'access'),
    function () { //admin level access
        Route::get(
            '/users/add',
            function () {
                return View::make('manage/adduser');
            }
        );
		Route::get('/users/group/{id}/{mode}', 'UsersController@ChangeGroup');
        Route::post('/users/add', 'UsersController@AddUser');
        Route::get('/users', 'UsersController@ListUsers');
        Route::get('/users/delete/{id}/{type}', 'UsersController@DeleteOrRestoreUser');
        Route::get('/charts/add', function () {
                return View::make('charts/add');
            }
        );
        Route::post('/charts/add', 'ChartsController@Create');
		Route::get('/charts/delete/{id}','ChartsController@Delete');
    }
);
Route::group(
    array('before' => 'guest'),
    function () { //only guests
        Route::get(
            "/login",
            array(
                "as" => "login",
                function () {
                    return View::make('manage/login');
                }
            )
        );
        Route::post("/login", 'UsersController@Login');
    }
);

Route::group(
    array('before' => 'auth'),
    function () { //logged in users
        Route::get(
            '/users/pass',
            function () {
                return View::make('manage/password');
            }
        );
        Route::get('/charts/vote/add/{beatmap}/{chart}/{mode}', 'ChartsController@addVote');
        Route::get('/charts/vote/remove/{vote}','ChartsController@removeVote');
        Route::post('/users/pass', 'UsersController@ChangePass');
        Route::get("/charts/view/{id}/{mode?}", 'ChartsController@ViewVoting');
        Route::get(
            "/logout",
            function () {
                Auth::logout();

                return Redirect::route("home");
            }
        );
    }
);
