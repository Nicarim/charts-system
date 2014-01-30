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
        return $this->hasMany('Beatmap')->orderBy("osumode", 'desc');
    }


    public function taikomaps() {
        return $this->hasMany('Beatmap')->orderBy("taikomode", 'desc');
    }


    public function ctbmaps() {
        return $this->hasMany('Beatmap')->orderBy("ctbmode", 'desc');
    }


    public function ommaps() {
        return $this->hasMany('Beatmap')->orderBy("maniamode", 'desc');
    }

    public function votes() {
        return $this->hasMany('Vote');
    }
} 
