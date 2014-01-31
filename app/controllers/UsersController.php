<?php

/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 25.01.14
 * Time: 10:19
 */
class UsersController extends BaseController {

    public function Login() {
        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if (Auth::attempt($user)) {
            return Redirect::route('home');
        }

        return Redirect::route('login')->with(
            'error',
            'Your username/password was wrong, are you sure you have an account?'
        );
    }


    public function AddUser() {
        $data = array(
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password')),
            'team' => Input::get('team')
        );
        if (Input::get('osu') == "yes")
        {
            $data['osu'] = 1;
        }
        if (Input::get('taiko') == "yes")
        {
            $data['taiko'] = 1;
        }
        if (Input::get('ctb') == "yes")
        {
            $data['ctb'] = 1;
        }
        if (Input::get('mania') == "yes")
        {
            $data['mania'] = 1;
        }
        $validator = Validator::make($data, array('username' => 'unique:users,username'));
        if ($validator->fails()) {
            return Redirect::to('/users/add')->with('error', $data['username'] . ' already exists!');
        }
        $user = User::create($data);

        return Redirect::to('/users/add')->with('error', $user->username . ' added!');
    }


    public function ListUsers($banned = false) {
        if ($banned == "banned")
        {
            return View::make('manage/listusers')->with(array(
                    'users' => User::withTrashed()->get(),
                    'banned' => $banned
                ));
        }else{
            return View::make('manage/listusers')->with(array(
                    'users' => User::all(),
                    'banned' => $banned
                ));
        }

    }


    public function DeleteOrRestoreUser($id, $type) {
        if ($type == "restore") {
            $user = User::withTrashed()->where("id", $id);
            $user->restore();
        } else if ($type == "delete") {
            $user = User::find($id);
            $user->delete();
        } else {
            return Redirect::to('/users/list');
        }

        return Redirect::to('/users/list/banned');
    }


    public function ChangePass() {
        $data = array(
            "password" => Input::get("password"),
            "confirm_password" => Input::get("confirm_password")
        );
        if ($data['password'] == $data['confirm_password']) {
            $user = Auth::user();
            $user->password = Hash::make($data['password']);
            $user->save();

            return Redirect::to('/users/pass')->with('error', 'Password changed!');
        } else {
            return Redirect::to('/users/pass')->with('error', 'First password is different than second');
        }
    }
	public function ChangeGroup($id,$mode){
		$user = User::find($id);
		switch ($mode)
		{
			case "osu":
				if ($user->allowedMode($mode) == 1)
					$user->osu = 0;
				else
					$user->osu = 1;
			break;
			case "taiko":
				if ($user->allowedMode($mode) == 1)
					$user->taiko = 0;
				else
					$user->taiko = 1;
			break;
			case "ctb":
				if ($user->allowedMode($mode) == 1)
					$user->ctb = 0;
				else
					$user->ctb = 1;
			break;
			case "mania":
				if ($user->allowedMode($mode) == 1)
					$user->mania = 0;
				else
					$user->mania = 1;
			break;
		}
		$user->save();
        return Redirect::to("/users");
	}
} 
