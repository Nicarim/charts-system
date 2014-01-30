<?php

class ChartsController extends BaseController {
    public $layout = "master";
    public $apikey = "459fc9f4860d2966cd935c9ecd66d7caf5bf9f13";
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
        $votes = Vote::where("gamemode", "=", $this->gamemode[$mode])->where('user_id', '=', Auth::user()->id)->where("chart_id",'=',$id)->get();
        $voteskv = array();
        foreach ($votes as $vote){
            $voteskv[$vote->beatmap_id] = $vote->id;
        }
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
                "votes" => $voteskv,
                "maps" => $maps
            ));
    }


    public function Create() {
        $data = array(
            "name" => Input::get("title"),
            "type" => Input::get('type'),
            "beatmapids" => Input::get("beatmapsetids"),
            "max_votes" => Input::get("votescount"),
            "end_time" => Input::get("date")
        );
        $chart = Chart::create($data);
        $beatmaps = explode(",",$data['beatmapids']);
        foreach($beatmaps as $beatmapid)
        {
            $beatmap = new Beatmap;
            $jsondata = json_decode(file_get_contents("https://osu.ppy.sh/api/get_beatmaps?k=".$this->apikey."&s=".$beatmapid));
            $beatmap->beatmapset_id = $jsondata[0]->beatmapset_id;
            $beatmap->artist = $jsondata[0]->artist;
            $beatmap->title = $jsondata[0]->title;
            $beatmap->creator = $jsondata[0]->creator;
            $beatmap->chart_id = $chart->id;
            foreach($jsondata as $mode){
                if ($mode->mode == "0"){
                    $beatmap->osumode = 1;
                }
                if ($mode->mode == "1"){
                    $beatmap->taikomode = 1;
                }
                if ($mode->mode == "2"){
                    $beatmap->ctbmode = 1;
                }
                if ($mode->mode == "3"){
                    $beatmap->maniamode = 1;
                }
            }
            $beatmap->save();

        }
        return Redirect::to("/charts/add");
    }
	public function Delete($id){
		$chart = Chart::find($id);
		$maps = Chart::where("chart_id", "=", $id);
		foreach ($maps as $map)
		{
			$map->delete();
            $votes = Vote::where("beatmap_id", "=", $map->id);
            if (count($votes) > 0){
                foreach ($votes as $vote){
                    $vote->delete();
                }
            }
		}
		$chart->delete();
        return Redirect::to("/charts");
	}
    public function View() {
        $charts = Chart::all();
        return View::make('charts/view')->with("charts",$charts);
    }
    public function addVote($beatmap, $chart, $mode){
        if (Auth::user()->votes->count() <= $chart->max_votes){
            $vote = new Vote;
            $vote->user_id = Auth::user()->id;
            $vote->chart_id = $chart;
            $vote->beatmap_id = $beatmap;
            $vote->gamemode = $this->gamemode[$mode];
            $vote->save();
        }
        return Redirect::to("/charts/view/".$chart."/".$mode);
    }
    public function removeVote($id){
        $vote = Vote::find($id);
        $chart = $vote->chart_id;
        $mode = array_flip($this->gamemode)[$vote->gamemode];
        $vote->delete();
        return Redirect::to("/charts/view/".$chart."/".$mode);
    }
}
