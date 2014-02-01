<?php

/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 24.01.14
 * Time: 17:28
 */
class Vote extends Eloquent {
    protected $fillable = array('chart_id','user_id','beatmap_id','gamemode');
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
    public function scopeMode($query, $mode) {
        return $query->where("gamemode", "=", $mode)
            ->selectRaw("count(votes) as vote_count")->orderBy("vote_count", "desc");
    }
}
