<?php

class AdminNotificationsController extends \BaseController {

    public function index()
    {
        Assets::add(url()."/public/js/tai/taipages/notifications.js");
        return View::make("admin.skin")->nest("content","admin.notifications");

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$text = Input::get("text");
        $users = User::get(array("id"));
        $arr = array();
        foreach($users as $val){
                 $arr[] = array("user_id" => $val->id, "free_text"=>$text, 'type' => "admin", "show_method" => "box");

        }
        if(count($arr) > 0) {
            Notifications::insert($arr);
        }

    }





}
