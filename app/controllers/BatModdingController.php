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
        $modpost['topic_name'] = $data['topic_name'];
        $modpost['subforum_id'] = $data['subforum_id'];
        $modpost['subforum_name'] = $data['subforum_name'];
        $modpost['icon_id'] = $data['icon_id'];
        $modpost['user_id'] = $data['user_id'];
        $modpost['user_name'] = $data['user_name'];
        $modpost['post_id_before'] = $data['post_id_before'];
        switch ($data['icon_id'])
        {
            case 5:
                $modpost['icon_name'] = "Star";
                break;
            case 7:
                $modpost['icon_name'] = "Bubble";
                break;
            case 4:
                $modpost['icon_name'] = "Ranked";
                break;
            case 1:
                $modpost['icon_name'] = "Approved";
                break;
            case 6:
                $modpost['icon_name'] = "Nuked";
                break;
            case 12:
                $modpost['icon_name'] = "Popped Bubble";
                break;
            case 13:
                $modpost['icon_name'] = "Unranked";
                break;
            case 14:
                $modpost['icon_name'] = "Osu! Icon";
                break;
            case 15:
                $modpost['icon_name'] = "Taiko Icon";
                break;
            case 16:
                $modpost['icon_name'] = "CtB Icon";
                break;
            case 17:
                $modpost['icon_name'] = "Mania Icon";
                break;
            default:
                $modpost['icon_name'] = "None";
                break;
        }
        $modpost->save();
        return "success";
    }
} 