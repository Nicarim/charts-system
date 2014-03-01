<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 27.02.14
 * Time: 18:17
 */

namespace osu\Helper;

class osuHelper {
    public static function modsAvailable(){
        return $array = array(
            "Freemod"        => 8192,
            "None"           => 16384,
            "NoFail"         => 1,
            "Easy"           => 2,
            "Hidden"         => 8,
            "HardRock"       => 16,
            "SuddenDeath"    => 32,
            "DoubleTime"     => 64,
            "HalfTime"       => 256,
            "Nightcore"      => 512,
            "Flashlight"     => 1024,
            "SpunOut"        => 4096,

        );
    }
    public static function gamemodeString($id){
        switch($id){
            case 0:
                return "osu!";
            case 1:
                return "Taiko";
            case 2:
                return "Catch the Beat";
            case 3:
                return "osu!mania";
            default:
                return "Wrong Gamemode";
        }
    }
    public static function modString($bit){
        $array = osuHelper::modsAvailable();
        $string = "";
        foreach($array as $key => $value){
            if (($bit & $value) == $value){
                if ($string != "")
                    $string = $string.' '.$key;
                else
                    $string = $key;
            }
        }
        return $string;
    }
    public static function statusString($id){
        switch($id){
            case -1:
                return "Completed";
            case 0:
                return "Pending";
            case 1:
                return "Nominated";
            case 2:
                return "Approved";
            default:
                return "Wrong Type";
        }
    }
    public static function statusCss($id){
        switch($id){
            case -1:
                return "label-success";
            case 0:
                return "label-info";
            case 1:
                return "label-warning";
            case 2:
                return "label-danger";
            default:
                return "Wrong Type";
        }
    }
    public static function statusIcon($id){
        switch($id){
            case -1:
                return "glyphicon glyphicon-ok";
            case 0:
                return "glyphicon glyphicon-search";
            case 1:
                return "glyphicon glyphicon-plus";
            case 2:
                return "glyphicon glyphicon-heart";
            default:
                return "Wrong Type";
        }
    }
    public static function gamemodeCss($id){
        switch ($id){
            case 0:
                return "osu";
            case 1:
                return "taiko";
            case 2:
                return "ctb";
            case 3:
                return "mania";

        }
    }
    public static function urlGenerator($variable, $value){

        $string = "?";
        if (\Illuminate\Http\Request\has('gamemode'))
        {
            if ($variable == "gamemode")
                $string = $string."gamemode=".$value;
            else
                $string = $string."gamemode=".\Illuminate\Http\Request\input('gamemode');
        }
        if (\Illuminate\Http\Request\has('status'))
        {
            if ($variable == "status")
                $string = $string."status=".$value;
            else
                $string = $string."status=".\Illuminate\Http\Request\input('status');
        }

        return $string;

    }
} 