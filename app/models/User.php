<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function votes() {
        return $this->hasMany('Vote');
    }


    protected $hidden = array('password');

    protected $fillable = array('username', 'password', 'team');

    protected $softDelete = true;


    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }


    public function isAdmin() {
        if ($this->power < 3) {
            return false;
        } else {
            return true;
        }
    }
    public function allowedMode($mode){
        if ($mode == "osu")
        {
            if ($this->osu == 1)
                return true;
            else
                return false;
        }
        if ($mode == "taiko")
        {
            if ($this->taiko == 1)
                return true;
            else
                return false;
        }
        if ($mode == "ctb")
        {
            if ($this->ctb == 1)
                return true;
            else
                return false;
        }
        if ($mode == "mania")
        {
            if ($this->mania == 1)
                return true;
            else
                return false;
        }
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }


    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }
}
