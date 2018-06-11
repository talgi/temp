<?php

class AdminLotteriesCatController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Assets::add(url()."/public/js/tai/taipages/lotteries-cat.js");
        $data = array();
        $data['cats'] = Lotteries::getCats(Config::get("app.locale"));
        return View::make("admin.skin")->nest("content","admin.lotteries-cat",$data);
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
        $cat = Lotteries::createCat(Input::all());
        return View::make("admin.components.createlottorie",array("cat"=>$cat))->render();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        Assets::add(url()."/public/js/tai/taipages/lotteries.js");
        Assets::add(url()."/public/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css");
        Assets::add(url()."/public/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");
        $data = array();
        $data['lotteries'] = Lotteries::getCatLotteries($id);
        $data['catID'] = $id;
        return View::make("admin.skin")->nest("content","admin.lotteries",$data);
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
		Lotteries::updateCat(Input::all(),$id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
