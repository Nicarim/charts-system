<?php

class ChartsController extends BaseController {
    public $layout = "master";
    public $gamemode = array(
        "osu" => 0,
        "taiko" => 1,
        "ctb" => 2,
        "mania" => 3,
    );
    public function ViewVoting($id = NULL, $mode = "osu") {
        $gamemodenames = array(
          "osu" => "osu!",
          "taiko" => "Taiko",
          "ctb" => "Catch the Beat",
          "mania" => "osu!mania"
        );
        if ($id == NULL) {
            return Redirect::to('/charts');
        }
        if (array_search($mode, array_flip($this->gamemode)) === false)
            return Redirect::to('/');
        Auth::user()->touch(); //activity check
        $chart = Chart::find($id);
        $votes = Vote::where("gamemode", "=", $this->gamemode[$mode])->get();
        if ($mode == "osu")
            $maps = $chart->osumaps;
        else if ($mode == "taiko")
            $maps = $chart->taikomaps;
        else if ($mode == "ctb")
            $maps = $chart->ctbmaps;
        else if ($mode == "mania")
            $maps = $chart->ommaps;

        return View::make('charts/vote')->with(array(
                "chart" => $chart,
                "mode" => $mode,
                "nameshelper" => $gamemodenames,
                "votes" => $votes,
                "maps" => $maps
            ));
    }


    public function Create() {
        $data = array(
            "name" => Input::get("title"),
            "type" => Input::get('type')
        );
        $chart = Chart::create($data);

        return Redirect::to("/charts/add");
    }


    public function View() {
        $charts = Chart::all();

        return View::make('charts/view')->with("charts",$charts);
    }
    public function Vote($beatmap, $chart, $mode, $type){
        if($type == "add")
        {
            $vote = new Vote;
            $vote->user_id = Auth::user()->id;
            $vote->chart_id = $chart;
            $vote->beatmap_id = $chart;
            $vote->gamemode = $this->gamemode[$mode];
            $vote->save();
            return Redirect::to("/charts/view/".$chart."/".$mode);
        }else if($type == "remove"){

        }else{
            return Redirect::to("/");
        }
    }
}
