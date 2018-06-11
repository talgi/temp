<?php

class CodesController extends \BaseController {


	public function store()
	{
        $code = Input::get("code");
        $code = strtoupper($code);
        $code = str_replace(array(" ", "-" ,"_"),"",$code);
		$res = Codes::addUserToCode($code,Auth::id());
        $response = new stdClass();
        if(!$res){
            $response->success = 0;
            $response->error = "invalid code or this code is all ready be redeemed";
            return Response::json($response);
        }
        else{
            $response->success = 1;
            $response->booklet = $res;
            return Response::json($response);
        }

	}





}
