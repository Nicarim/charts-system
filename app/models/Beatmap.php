<?php

/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 24.01.14
 * Time: 17:29
 */
class Beatmap extends Eloquent {

    protected $table = "beatmaps";
    protected $fillable = array("id","artist","title","creator","osumode","ctbmode","taikomode","maniamode","chart_id");
    function votes($mode){
        return $this->hasMany('vote')->where('gamemode','=',$mode);
    }
} 
