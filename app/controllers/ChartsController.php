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
        if (strtotime($chart->end_time) <= time())
        {
            return View::make('charts/vote')->with(array(
                    "chart" => $chart,
                    "mode" => $mode,
                    "nameshelper" => $gamemodenames,
                    "votes" => $voteskv,
                    "maps" => $maps,
                    "theend" => true
                ));
        }
        else
        {
            return View::make('charts/vote')->with(array(
                    "chart" => $chart,
                    "mode" => $mode,
                    "nameshelper" => $gamemodenames,
                    "votes" => $voteskv,
                    "maps" => $maps,
                    "theend" => false
                ));
        }
    }
    public function ViewResults($id,$mode="osu",$csv=null){
        $beatmaps = Beatmap::where("chart_id","=",$id)->get();
        $chart = Chart::find($id);
        if (strtotime($chart->end_time) <= time() || Auth::user()->isAdmin())
        {
            $beatmapsvar = array();
            foreach($beatmaps as $beatmap){
                $votenames = array();
                foreach($beatmap->votes as $vote)
                {
                    if ($vote->gamemode == $this->gamemode[$mode])
                        $votenames[] = $vote->user->username;
                }
                $beatmapsvar[] = array(
                    "mapset_id" => $beatmap->beatmapset_id,
                    "artist" => $beatmap->artist,
                    "title" => $beatmap->title,
                    "creator" => $beatmap->creator,
                    "votes" => $beatmap->votes()->mode($this->gamemode[$mode])->count(),
                    "vote_names" => implode(",",$votenames)
                );
            }
            $sortArray = array();
            foreach($beatmapsvar as $beatmap){
                foreach($beatmap as $key => $value){
                    if(!isset($sortArray[$key])){
                        $sortArray[$key] = array();
                    }
                    $sortArray[$key][] = $value;
                }
            }

            $orderby = "votes"; //variable to sort by

            array_multisort($sortArray[$orderby],SORT_DESC,$beatmapsvar);
            if($csv == null)
            {
                return View::make('charts/results')->with(array(
                        "id" => $id,
                        "modeid" => $this->gamemode[$mode],
                        "mode" => $mode,
                        "beatmapslist" => $beatmapsvar
                    ));
            }elseif ($csv == "maps_csv" && Auth::user()->isAdmin()){
                $csvoutput = array();
                $csvoutput[] = "artist,title,creator,mapset_id,vote_amount,vote_names";
                $beatmapsvar = str_replace("\"","'",$beatmapsvar);
                foreach ($beatmapsvar as $beatmap)
                {
                    $csvoutput[] = '"'.$beatmap['artist'].'","'.$beatmap['title'].'","'.$beatmap['creator'].'",'.$beatmap['mapset_id'].','.$beatmap['votes'].',"'.$beatmap['vote_names'].'"';
                }
                $headers = array(
                  "Content-Type" => "text/csv",
                  "Content-Disposition" => 'attachment; filename="ExportVotes.csv"'
                );

                return Response::make(rtrim(implode("\n",$csvoutput),"\n"), 200, $headers);
            }elseif ($csv == "users_csv" && Auth::user()->isAdmin()){
                $csvoutput = array();
                $csvoutput[] = "playername,votes_amount";
                $users = User::all();
                foreach($users as $user){
                    $csvoutput = "\"".$user->username."\",".$user->ChartVotes($chart->id)->count();
                }
                $headers = array(
                    "Content-Type" => "text/csv",
                    "Content-Disposition" => 'attachment; filename="ExportUserVotes.csv"'
                );

                return Response::make(rtrim(implode("\n",$csvoutput),"\n"), 200, $headers);
            }
        }
        else
            return Redirect::to("/");
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
            $this->AddBeatmapModel($beatmapid, $chart->id);
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
        $chartmodel = Chart::find($chart);
        $vote_id = 0;
        $votes = Vote::where("user_id", "=", Auth::user()->id)->where("gamemode", "=", $this->gamemode[$mode])->where("chart_id","=",$chart)->count();
        if (strtotime($chartmodel->end_time) >= time())
        {
            if ($votes < $chartmodel->max_votes){
                $vote = new Vote;
                $vote->user_id = Auth::user()->id;
                $vote->chart_id = $chart;
                $vote->beatmap_id = $beatmap;
                $vote->gamemode = $this->gamemode[$mode];
                $vote->save();
                $vote_id = $vote->id;
                return $vote_id;
            }
        }
        return "false";
    }
    public function removeVote($id){
        $vote = Vote::find($id);
        if (strtotime($vote->chart->end_time) >= time())
        {
            $chart = $vote->chart_id;
            $mode = array_flip($this->gamemode)[$vote->gamemode];
            $beatmap_id = $vote->beatmap_id;
            $vote->delete();
            return $chart.",".$beatmap_id.",".$mode;
        }
        return false;
    }
    public function AddBeatmap($id){
        $data = Input::get("beatmapids");
        $beatmaps = explode(',',$data);
        foreach($beatmaps as $beatmapid){
            $this->AddBeatmapModel($beatmapid,$id);
        }
        return Redirect::to("/charts/view/".$id);
    }
    private function AddBeatmapModel ($beatmapid, $chartid){
        $beatmap = new Beatmap;
        $jsondata = json_decode(file_get_contents("https://osu.ppy.sh/api/get_beatmaps?k=".$this->apikey."&s=".$beatmapid));
        $beatmap->beatmapset_id = $jsondata[0]->beatmapset_id;
        $beatmap->artist = $jsondata[0]->artist;
        $beatmap->title = $jsondata[0]->title;
        $beatmap->creator = $jsondata[0]->creator;
        $beatmap->chart_id = $chartid;
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
}
