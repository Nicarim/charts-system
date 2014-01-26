<?php

/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 24.01.14
 * Time: 17:28
 */
class Vote extends Eloquent {

    protected $table = "votes";
    public function Chart(){
        return $this->belongsTo("Chart");
    }
    public function User(){
        return $this->belongsTo("User");
    }
    public function Map(){
        return $this->belongsTo("Map");
    }
}
