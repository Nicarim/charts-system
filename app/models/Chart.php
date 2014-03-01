<?php

/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 24.01.14
 * Time: 17:26
 */
class Chart extends Eloquent {

    protected $table = "charts";

    protected $fillable = array("name", "type", "max_votes", "end_time");


    public function osumaps() {
        return $this->hasMany('Beatmap')->where("osumode","=","1")->orderBy("osumode", 'desc');
    }


    public function taikomaps() {
        return $this->hasMany('Beatmap')->where("taikomode","=","1")->orderBy("taikomode", 'desc');
    }


    public function ctbmaps() {
        return $this->hasMany('Beatmap')->whereRaw("beatmaps.osumode = 1 or beatmaps.ctbmode = 1")->orderBy("ctbmode", 'desc');
    }


    public function ommaps() {
        return $this->hasMany('Beatmap')->whereRaw("beatmaps.osumode = 1 or beatmaps.maniamode = 1")->orderBy("maniamode", 'desc');
    }

    public function votes() {
        return $this->hasMany('Vote');
    }
    public function user(){
        return $this->belongsTo("User");
    }
    public function comments(){
        return $this->hasMany("Comment");
    }
} 
