<?php

class AdminInnerPagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        Assets::addCss(url()."/public/components/summernote/dist/summernote.css");
        Assets::add(url()."/public/components/summernote/dist/summernote.min.js");
        Assets::add(url()."/public/js/tai/taipages/inner-pages.js");

        $view = InnerPages::getPage($id);
        if($view){
            return    View::make("admin.skin")->nest("content","admin.inner-page",array("view" => $view));
        }
        else{
            return "page not found";
        }

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		InnerPages::setPage($id,Input::all());
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
