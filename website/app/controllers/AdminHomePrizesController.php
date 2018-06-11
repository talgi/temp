<?php

class AdminHomePrizesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Assets::add(url()."/public/js/tai/taipages/homeprizes.js");
        $data = array();
        $data['prizes'] = HomePrizes::getPrizes();
        return View::make("admin.skin")->nest("content","admin.homeprizes",$data);
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
        $image = Input::get("image");

        if(!empty($image))
        {
            $arr['image'] = createImage($image , "png");
        }

		$prize = HomePrizes::create($arr);
        return    View::make("admin.components.homeprizesitem",array("prize" => $prize));

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
        $homePrizes = HomePrizes::find($id);
        $homePrizes->text = Input::get("text");
        $image = Input::get("image");
        if(!empty($image))
        {
            $homePrizes->image = createImage($image , "png");
        }
        $homePrizes->save();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $homePrizes = HomePrizes::find($id);
        $homePrizes->delete();
	}


}
