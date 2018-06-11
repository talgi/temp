<?php

class GeneralController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


    public function getNextLottery(){
        $json = new stdClass();
        $json->nextLotteries = Lotteries::get4ClosetsLotteries();
        return Response::json($json);
    }

    public function postContact()
    {
        $rules = array(
            'email' => 'required|email',
            'fullname' => 'required|between:2,50',
            'telephone' => 'max:50',
            'subject' => 'max:150',
            'enquiry' => 'max:800'

        );
        $validator = Validator::make(Input::all(), $rules);
        $response =  new stdClass();
        $response->success = 0;
        if ($validator->passes()) {
            Mail::send('emails.contact', Input::all(), function ($message)  {
                $message->to("info@flipmadness.co.uk")->subject('Contact as request from flipmadness.co.uk');
            });

            $response->success = 1;
        }
        else{
            $response->success = 0;
            $response->error = $validator->messages()->all();
        }

        return Response::json($response);
    }

    public function getInner($page)
    {
        $view = InnerPages::getPage($page);
        $response = new stdClass();
        if($view){
            $response->success = 1;
            $response->view = $view;
        }
        else{
            $response->success = 0;
        }
        return Response::json($response);
    }

}
