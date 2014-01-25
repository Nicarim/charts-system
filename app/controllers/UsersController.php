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
            'Your username/password was wrong, are you sure you have account?'
        );
    }


    public function AddUser() {
        $data = array(
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password')),
            'team' => Input::get('team')
        );
        $validator = Validator::make($data, array('username' => 'unique:users,username'));
        if ($validator->fails()) {
            return Redirect::to('/users/add')->with('error', $data['username'] . ' already exists!');
        }
        $user = User::create($data);

        return Redirect::to('/users/add')->with('error', $user->username . ' added!');
    }


    public function ListUsers() {
        return View::make('layouts/manage-listusers')->with('users', User::withTrashed()->get());
    }


    public function DeleteOrRestoreUser($id, $type) {
        if ($type == "restore") {
            $user = User::withTrashed()->where("id", $id);
            $user->restore();
        } else if ($type == "delete") {
            $user = User::find($id);
            $user->delete();
        } else {
            return Redirect::to('/users');
        }

        return Redirect::to('/users');
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
} 
