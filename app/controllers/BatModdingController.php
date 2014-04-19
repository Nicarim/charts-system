<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 19.04.14
 * Time: 16:00
 */

class BatModdingController extends BaseController{
    function addModPost()
    {
        $data = Input::all();
        $modpost = new BatMod;
        $modpost['topic_id'] = $data['topic_id'];
        $modpost['subforum'] = $data['subforum_id'];
        $modpost['icon_id'] = $data['icon_id'];
        $modpost['user_id'] = $data['user_id'];
        $modpost->save();
        return "success";
    }
} 