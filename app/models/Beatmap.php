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
    public function votes(){
        return $this->hasMany('Vote');
    }
} 
