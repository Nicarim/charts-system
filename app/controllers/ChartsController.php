<?php

class ChartsController extends BaseController {

    public function ViewVoting($id = NULL, $mode = "osu") {
        $gamemode = array(
          "osu" => 0,
          "taiko" => 1,
          "ctb" => 2,
          "mania" => 3,
        );
        $gamemodenames = array(
          "osu" => "osu!",
          "taiko" => "Taiko",
          "ctb" => "Catch the Beat",
          "mania" => "osu!mania"
        );
        if ($id == NULL) {
            return Redirect::to('/charts');
        }
        if (array_search($mode, array_flip($gamemode)) === false)
            return Redirect::to('/');
        Auth::user()->touch(); //activity check
        $chart = Chart::find($id);
        $votes = Vote::where("gamemode", "=", $gamemode[$mode])->get();

        return View::make('layouts/charts-vote')->with(array(
                "chart" => $chart,
                "mode" => $mode,
                "nameshelper" => $gamemodenames,
                "votes" => $votes,
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

        return View::make('layouts/charts-view')->with('charts', $charts);
    }
    public function Vote($beatmap, $chart, $mode){

    }
}
