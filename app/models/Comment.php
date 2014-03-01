<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 01.03.14
 * Time: 12:11
 */

class Comment extends Eloquent {
    protected $table = "comments";
    protected $guarded = array();
    public function user(){
        return $this->belongsTo("User");
    }
    public function chart(){
        return $this->belongsTo("Chart");
    }
} 