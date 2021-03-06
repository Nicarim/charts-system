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
Route::get("/ip_counter", array(
        "uses" => "IpCounterController@newIp"
    ));
Route::get("/ip_counter_list", array(
        "uses" => "IpCounterController@getListOfIps"
    ));
Route::get('/ip_counter_assoc/{id}', array(
       "uses" => "IpCounterController@assocProfile"
    ));
Route::post("/bss/posting", array(
        "as" => "Bats",
        "uses" => "BatModdingController@addModPost"
    ));

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
        Route::get('/users/list/{banned?}', array(
            "as" => "userslist",
            "uses" => 'UsersController@ListUsers'
        ));
        Route::get('/users/delete/{id}/{type}', 'UsersController@DeleteOrRestoreUser');
        Route::get('/charts/add', function () {
                return View::make('charts/add');
            }
        );
        Route::post('/charts/add', 'ChartsController@Create');
        Route::post('/charts/add_beatmap/{id}', 'ChartsController@AddBeatmap');

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
        Route::get('/charts/add_specific', function () {
                return View::make('charts/add-specific');
            }
        );
        Route::get('/charts/delete/{id}','ChartsController@Delete');
        Route::post('/charts/add_specific', 'ChartsController@CreateSpecific');
        Route::get('/charts/vote/add/{beatmap}/{chart}/{mode}', 'ChartsController@addVote');
        Route::get('/charts/vote/remove/{vote}','ChartsController@removeVote');
        Route::post('/users/pass', 'UsersController@ChangePass');
        Route::get('/charts/view-specific/{id}', 'ChartsController@ViewSpecific');
        Route::post('/charts/add_specific-beatmap/{id}', 'ChartsController@AddSpecificBeatmap');
        Route::post('/charts/add_comment/{id}', 'ChartsController@AddComment');
        Route::get('/charts/remove_comment/{id}', 'ChartsController@RemoveComment');
        Route::get('/charts/remove_specific-beatmap/{id}', 'ChartsController@RemoveSpecificBeatmap');
        Route::get("/charts/view/{id}/{mode?}", 'ChartsController@ViewVoting');
        Route::get(
            "/logout",
            function () {
                Auth::logout();

                return Redirect::route("home");
            }
        );
        Route::get('/charts/results/{id}/{mode?}/{csv?}','ChartsController@ViewResults');
        Route::get("/charts/list/{status?}", array(
            "uses" => 'ChartsController@View',
            "as" => 'listing'
        ));
    }
);
