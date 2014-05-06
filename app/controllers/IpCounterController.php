<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 06.05.14
 * Time: 21:07
 */

class IpCounterController extends BaseController{
    public function newIp(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REQUEST_URI']))
            $referer = $_SERVER['REQUEST_URI'];
        else
            $referer = "none";
        $data = json_decode(file_get_contents("https://freegeoip.net/json/".$ip));
        $entry = IpCounter::firstOrNew(array(
               "address" => $ip,
               "city" => $data->city
            ));
        if ($entry->exists())
            $entry->count += 1;
        else
            $entry->count = 1;
        $entry->country_code = $data->country_code;
        $entry->country_name = $data->country_name;
        $entry->referal_page = $referer;
        $entry->save();
        return Response::make(File::get(public_path()."/icons/ctb.gif"), 200, array(
                "Content-type" => "image/gif"
            ));
    }
    public function getListOfIps(){
        $ips = IpCounter::orderBy("count")->get();
        if (Auth::check() && Auth::user()->id == 1){
            return View::make('ips')
                ->with('ips', $ips);
        }
    }
} 