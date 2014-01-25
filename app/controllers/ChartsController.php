<?php

class ChartsController extends BaseController {

    public function ViewVoting($id = NULL, $mode = "osu") {
        if ($id == NULL) {
            return Redirect::to('/charts');
        }
        Auth::user()->touch(); //activity check
        $chart = Chart::find($id);

        return View::make('layouts/charts-vote')->with('chart', $chart);
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
}
