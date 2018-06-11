<?php

class AdminMedalsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Assets::add(url()."/public/js/tai/taipages/medals.js");
        $data = array();
        $data['medals'] = Medals::getMedals();
        return View::make("admin.skin")->nest("content","admin.medal",$data);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $arr['text'] = Input::get("text");
        $arr['lang'] = Config::get("app.locale");
        $arr['views'] = Input::get("views");
        $arr['reword'] = Input::get("reword");
        $arr['notification_text'] = Input::get("notification_text");


        $medal = Medals::create($arr);
        return View::make("admin.components.medalitem", array("medal" => $medal));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $medal = Medals::find($id);
        $medal->text = Input::get("text");
        $medal->views = Input::get("views");
        $medal->reword = Input::get("reword");
        $medal->notification_text = Input::get("notification_text");

        $medal->save();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $medal = Medals::find($id);
        $medal->delete();
    }


}
